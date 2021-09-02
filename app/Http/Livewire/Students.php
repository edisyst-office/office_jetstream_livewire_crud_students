<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;

class Students extends Component
{
    public $students, $first_name, $last_name, $address, $student_id;
    public $isOpen = 0;


    public function render()
    {
        $this->students = Student::all();
        return view('livewire.students');
    }

    public function openModal()  {  $this->isOpen = true;  }

    public function closeModal() {  $this->isOpen = false;  }

    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name = '';
        $this->address = '';
        $this->student_id = '';
    }



    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }


    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
        ]);

        //UPDATE: considera anche 'id'
        //INSERT: in SQL non lo imposta
        Student::updateOrCreate(['id' => $this->student_id], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address
        ]);

        session()->flash('message',
            $this->student_id ? 'Student Updated Successfully.' : 'Student Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->first_name = $student->first_name;
        $this->last_name = $student->last_name;
        $this->address = $student->address;

        $this->openModal();
    }


    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Student Deleted Successfully.');
    }
}

?>