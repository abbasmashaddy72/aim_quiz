<?php

namespace App\Http\Livewire\Frontend\Form;

use App\Models\Question;
use App\Models\QuizUser;
use App\Models\Result;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class ReadyQuiz extends Component
{
    // Model Custom Quiz User Value
    public $quizUserId, $name, $father_name, $gender, $dob, $location, $mobile, $aic;
    // Model Custom Topic Value
    public $topic, $topicData;
    // Model Custom Question Values
    public $count, $quizSize, $currentQuestion, $restricted_age;
    // Model Custom Result Values
    public $currentQuizAnswers, $quizPercentage, $totalQuizQuestions, $currentResultData, $answeredQuestionsWithOptions;
    // Custom Values
    public $quizRegister = true; // Progress
    public $quizSlides = false; // Progress
    public $quizInProgress = false; // Progress
    public $quizDeclaration = false; // Progress
    public $showResult = false; // Progress
    public $preRegister = false; // Progress
    public $isDisabled = true; // Button
    public $userAnswered; // Checkbox
    public $answeredQuestions = []; // Answered Question List

    protected $rules = [
        'name' => 'required',
        'father_name' => '',
        'gender' => 'required',
        'dob' => 'required',
        'location' => 'required',
        'mobile' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/',
        'aic' => 'required',
    ];

    public function registerQuizUser() // Registered User
    {
        $validatedData = $this->validate();

        $validatedData['unique_id'] = Str::random(5);
        $current_dob = $validatedData['dob'];
        $new_dob = new Carbon();
        $validatedData['dob'] = $new_dob->subYears($current_dob)->format('Y-m-d');

        $quizUserData = QuizUser::create($validatedData);
        $this->quizUserId = $quizUserData->id;

        if (!is_null($this->topic->matter)) {
            $this->quizRegister = false;
            $this->quizSlides = true;
        } else {
            $this->startQuiz();
        }
    }

    public function startQuiz()
    {
        $this->quizSlides = false;

        if ($this->topic->type == 'Marks') {
            $this->quizRegister = false;
            $this->preRegister = true;
        } else {
            $this->quizRegister = false;

            $this->topicData = Topic::where('id', $this->topic->id)->get();

            if ($this->dob == 0) {
                $this->topicData->transform(function ($category) {
                    $category->questions = Question::whereHas('topics', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();
                    return $category;
                });
            } elseif ($this->dob >= 12) {
                $this->topicData->transform(function ($category) {
                    $category->questions = Question::whereHas('topics', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->where('age_restriction', '=', '>=12')
                        ->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();
                    return $category;
                });
            } else {
                $this->topicData->transform(function ($category) {
                    $category->questions = Question::whereHas('topics', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->where('age_restriction', '=', '<=12')
                        ->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();
                    return $category;
                });
            }

            $this->quizSize = $this->topicData->first()->questions->count();

            $this->count = 1;
            $this->currentQuestion = $this->getNextQuestion();

            $this->quizInProgress = true;
        }
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
        if ($this->dob == 0) {
            $question = Question::where('topic_id', $this->topic->id)
                ->with('options')
                ->whereNotIn('id', $this->answeredQuestions)
                ->inRandomOrder()
                ->first();
        } elseif ($this->dob >= 12) {
            $question = Question::where('topic_id', $this->topic->id)
                ->with('options')
                ->whereNotIn('id', $this->answeredQuestions)
                ->where('age_restriction', '=', '>=12')
                ->inRandomOrder()
                ->first();
        } else {
            $question = Question::where('topic_id', $this->topic->id)
                ->with('options')
                ->whereNotIn('id', $this->answeredQuestions)
                ->where('age_restriction', '=', '<=12')
                ->inRandomOrder()
                ->first();
        }

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
            if (!is_null($this->topic->declaration)) {
                $this->quizInProgress = false;
                $this->quizDeclaration = true;
            } else {
                $this->showResults();
            }
        }

        $this->currentQuestion = $this->getNextQuestion();
    }

    public function showResults() // Show Results
    {
        $this->quizDeclaration = false;
        // Get a count of total number of quiz questions in Quiz table for the just finished quiz.
        $this->totalQuizQuestions = Result::where('topic_id', $this->topic->id)->where('quiz_user_id', $this->quizUserId)->count();
        // Get a count of correctly answered questions for this quiz.
        $this->currentQuizAnswers = Result::where('topic_id', $this->topic->id)
            ->where('correct', '1')
            ->where('quiz_user_id', $this->quizUserId)
            ->count();
        // Calculate score for updating the quiz_header table before finishing the quid.
        $this->quizPercentage = round(($this->currentQuizAnswers / $this->totalQuizQuestions) * 100, 2);
        // Hide quiz div and show result div wrapped in if statements in the blade template.
        $this->quizInProgress = false;
        $this->showResult = true;

        // Gets All Question Id's User Attended
        $this->currentResultData = Result::where('quiz_user_id', $this->quizUserId)->get();
        // dd($answeredQuestionIds);
        $this->answeredQuestionsWithOptions = Question::whereIn('id', $this->currentResultData->pluck('question_id'))->with('options')->get();
    }

    public function render()
    {
        return view('livewire.frontend.form.ready-quiz');
    }
}
