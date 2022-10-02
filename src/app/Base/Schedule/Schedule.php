<?php

namespace App\Base\Schedule;

use App\Base\Schedule\User\User;
use Illuminate\Console\Scheduling\Schedule as SystemSchedule;
use Throwable;

class Schedule
{
    protected \Illuminate\Console\Scheduling\Schedule $schedule;

    /**
     * Запуск планировщика.
     */
    public function run(SystemSchedule $schedule)
    {
        $this->schedule = $schedule;

        $this->user($schedule);

        $this->email($schedule);

        $this->system($schedule);
    }

    /**
     * Системные команды (например очистка токенов Laravel passport)
     */
    protected function system(SystemSchedule $schedule)
    {
        $schedule
            ->command('passport:purge --revoked')
            ->monthly();
    }

    /**
     * Рассылка почты
     */
    protected function email(SystemSchedule $schedule)
    {

    }

    protected function user(SystemSchedule $schedule)
    {
        $schedule->call(function () {
            try {
                app(User::class)->cleanOldEmailVerify();
            } catch (Throwable $e) {
                $this->scheduleTaskError(User::class, $e);
            }
        })->daily();

        $schedule->call(function () {
            try {
                app(User::class)->changeUserGroupToUsers();
            } catch (Throwable $e) {
                $this->scheduleTaskError(User::class, $e);
            }
        })->days(2);
    }

    /**
     * Обработка ошибки при выполнении задачи по расписанию.
     */
    protected function scheduleTaskError(string $task_name, Throwable $throwable)
    {
        error_log($task_name . ' > ' . $throwable->getMessage(), 0, 'schedule task error');
    }
}
