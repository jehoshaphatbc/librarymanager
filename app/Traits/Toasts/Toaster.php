<?php

namespace App\Traits\Toasts;

use Usernotnull\Toast\Concerns\WireToast;

trait Toaster
{
    use WireToast;

    protected $toastTitle;

    protected $nextPage = false;

    protected $toastDescription;

    /**
     * toast
     *
     * @param  mixed  $type
     * @param  mixed  $title
     * @param  mixed  $description
     * @return void
     */
    public function toast(string $type, string $title, string $description, bool $nextPage = false)
    {
        $this->toastTitle = $title;
        $this->toastDescription = $description;
        $this->nextPage = $nextPage;

        switch ($type) {
            case 'success':
                $this->success();
                break;
            case 'error':
                $this->error();
                break;
            case 'info':
                $this->info();
                break;
            case 'warning':
                $this->warning();
                break;
            default:
                break;
        }
    }

    /**
     * error
     *
     * @return void
     */
    public function error()
    {
        if ($this->nextPage) {
            return toast()
                ->danger($this->toastDescription, $this->toastTitle)
                ->pushOnNextPage();
        }

        return toast()
            ->danger($this->toastDescription, $this->toastTitle)
            ->push();
    }

    /**
     * success
     *
     * @return void
     */
    public function success()
    {
        if ($this->nextPage) {
            return toast()
                ->success($this->toastDescription, $this->toastTitle)
                ->pushOnNextPage();
        }

        return toast()
            ->success($this->toastDescription, $this->toastTitle)
            ->push();
    }

    /**
     * info
     *
     * @return void
     */
    public function info()
    {
        if ($this->nextPage) {
            return toast()
                ->info($this->toastDescription, $this->toastTitle)
                ->pushOnNextPage();
        }

        return toast()
            ->info($this->toastDescription, $this->toastTitle)
            ->push();
    }

    /**
     * warning
     *
     * @return void
     */
    public function warning()
    {
        if ($this->nextPage) {
            return toast()
                ->warning($this->toastDescription, $this->toastTitle)
                ->pushOnNextPage();
        }

        return toast()
            ->warning($this->toastDescription, $this->toastTitle)
            ->push();
    }
}
