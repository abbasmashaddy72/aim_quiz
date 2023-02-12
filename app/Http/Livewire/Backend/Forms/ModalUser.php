<?php

namespace App\Http\Livewire\Backend\Forms;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalUser extends ModalComponent
{
    use Actions;
    // Set Data
    public $user_id;
    // Model Values
    public $name, $email, $password;
    // Custom Values
    public $role;

    public function mount()
    {
        if (!empty($this->user_id)) {
            $data = User::findOrFail($this->user_id);
            $this->name = $data->name;
            $this->email = $data->email;
            $this->password = $data->password;
            if (!empty($data->roles->first()->name)) {
                $this->role = Role::where('name', $data->roles->first()->name)->pluck('id');
            }
        }
    }

    protected $rules = [
        'name' => '',
        'email' => '',
        'password' => '',
        'role' => ''
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $validatedData = $this->validate();

        if (!empty($this->user_id)) {
            if ($this->password != $validatedData['password']) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $role = $validatedData['role'];
            unset($validatedData['role']);

            User::where('id', $this->user_id)->update($validatedData);

            User::find($this->user_id)->roles()->sync($role);

            $this->notification()->success($title = 'User Updated Successfully!');
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);

            $role = $validatedData['role'];
            unset($validatedData['role']);

            $user = User::create($validatedData);

            User::find($user->id)->roles()->attach([$role]);

            $this->notification()->success($title = 'User Saved Successfully!');
        }

        $this->emit('refreshLivewireDatatable');

        $this->closeModal();
    }

    public function render()
    {
        $roles = Role::get();
        return view('livewire.backend.forms.modal-user', compact('roles'));
    }
}
