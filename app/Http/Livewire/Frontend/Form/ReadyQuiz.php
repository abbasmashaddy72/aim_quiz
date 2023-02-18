<?php

namespace App\Http\Livewire\Frontend\Form;

use App\Models\Question;
use App\Models\QuizUser;
use App\Models\Result;
use App\Models\Topic;
use Livewire\Component;

class ReadyQuiz extends Component
{
    // Model Custom Quiz User Value
    public $quizUserId, $name, $age, $location, $mobile;
    // Model Custom Topic Value
    public $topic, $selectedTopicId, $topic_pdf;
    // Model Custom Question Values
    public $count, $quizSize, $currentQuestion, $restricted_age;
    // Model Custom Result Values
    public $currentQuizAnswers, $quizPercentage, $totalQuizQuestions;
    // Custom Values
    public $quizRegister = true; // Progress
    public $quizSlides = false; // Progress
    public $quizInProgress = false; // Progress
    public $showResult = false; // Progress
    public $preRegister = false; // Progress
    public $isDisabled = true; // Button
    public $userAnswered; // Checkbox
    public $answeredQuestions = []; // Answered Question List

    protected $rules = [
        'name' => 'required',
        'age' => 'required',
        'location' => 'required',
        'mobile' => 'required|numeric|digits:10',
    ];

    public function registerQuizUser() // Registered User
    {
        $validatedData = $this->validate();

        $quizUser = QuizUser::create($validatedData);

        $topic_type = Topic::where('id', $this->selectedTopicId)->pluck('type')->first();

        if ($topic_type == 'Marks') {
            $this->quizRegister = false;
            $this->preRegister = true;
        } else {
            $this->quizRegister = false;

            $this->quizUserId = $quizUser->id; // $quizUser->id;
            $quizUserAge = $quizUser->age;

            if ($quizUserAge > 12) {
                $this->restricted_age = '>=12';
            } else {
                $this->restricted_age = '<=12';
            }

            $this->topic = Topic::where('id', $this->selectedTopicId)->get();

            $this->topic->transform(function ($category) {
                $category->questions = Question::whereHas('topics', function ($q) use ($category) {
                    $q->where('id', $category->id);
                })->where('age_restriction', '=', $this->restricted_age)
                    ->inRandomOrder()
                    ->take(5)
                    ->get();
                return $category;
            });
            $this->quizSize = $this->topic->first()->questions->count();

            $this->count = 1;
            $this->currentQuestion = $this->getNextQuestion();

            $this->quizSlides = true;
        }
    }

    public function startQuiz()
    {
        $this->quizSlides = false;
        $this->quizInProgress = true;
    }

    public function updatedUserAnswered() // User Answers
    {
        if (empty($this->userAnswered)) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function getNextQuestion() // Next Question
    {
        $question = Question::where('topic_id', $this->selectedTopicId)
            ->with('options')
            ->whereNotIn('id', $this->answeredQuestions)
            ->where('age_restriction', '=', $this->restricted_age)
            ->inRandomOrder()
            ->first();

        if ($this->count < $this->quizSize) {
            array_push($this->answeredQuestions, $question->id);
        }
        return $question;
    }

    public function nextQuestion() // Adding to Result
    {
        list($answerId, $isChoiceCorrect) = explode(',', $this->userAnswered);

        Result::create([
            'quiz_user_id' => $this->quizUserId,
            'topic_id' => $this->currentQuestion->topic_id,
            'question_id' => $this->currentQuestion->id,
            'option_id' => $answerId,
            'correct' => $isChoiceCorrect,
            'date' => now(),
        ]);

        $this->count++;

        $answerId = '';
        $isChoiceCorrect = '';
        $this->reset('userAnswered');
        $this->isDisabled = true;

        if ($this->count == $this->quizSize + 1) {
            $this->showResults();
        }

        $this->currentQuestion = $this->getNextQuestion();
    }

    public function showResults() // Show Results
    {
        $this->topic_pdf = Topic::where('id', $this->selectedTopicId)->pluck('pdf')->first();
        // Get a count of total number of quiz questions in Quiz table for the just finished quiz.
        $this->totalQuizQuestions = Result::where('topic_id', $this->selectedTopicId)->where('quiz_user_id', $this->quizUserId)->count();
        // Get a count of correctly answered questions for this quiz.
        $this->currentQuizAnswers = Result::where('topic_id', $this->selectedTopicId)
            ->where('correct', '1')
            ->where('quiz_user_id', $this->quizUserId)
            ->count();
        // Calculate score for updating the quiz_header table before finishing the quid.
        $this->quizPercentage = round(($this->currentQuizAnswers / $this->totalQuizQuestions) * 100, 2);
        // Hide quiz div and show result div wrapped in if statements in the blade template.
        $this->quizInProgress = false;
        $this->showResult = true;
    }

    public function render()
    {
        return view('livewire.frontend.form.ready-quiz');
    }
}
