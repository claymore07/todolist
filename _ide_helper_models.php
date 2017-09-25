<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Task
 *
 * @property int $id
 * @property string $title
 * @property int $todoListId
 * @property string|null $completedAt
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @property-read \App\Todolist $todolist
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereTodoListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereUpdatedAt($value)
 */
	class Task extends \Eloquent {}
}

namespace App{
/**
 * App\Todolist
 *
 * @property int $id
 * @property int $userId
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todolist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todolist whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todolist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todolist whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todolist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todolist whereUserId($value)
 */
	class Todolist extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $rememberToken
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Todolist[] $todolists
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

