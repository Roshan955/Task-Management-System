<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the task
            $table->text('description'); // Task description
            $table->date('due_date'); // Due date of the task
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending'); // Task status
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium'); // Task priority
            $table->unsignedBigInteger('user_id'); // Foreign key referencing 'users' table
            $table->timestamps(); // Created_at and updated_at timestamps

            // Foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Delete tasks if the related user is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks'); // Rollback operation
    }
}

?>