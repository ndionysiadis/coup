<?php

namespace App\Data;

use App\Enums\ToastPositionEnum;
use App\Enums\ToastTypeEnum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Spatie\LaravelData\Data;
use Throwable;

/** @typescript  */
class ToastData extends Data
{
    public function __construct(
        public ?string            $message,
        public ?ToastTypeEnum     $type,
        public ?ToastPositionEnum $position
    )
    {
    }

    public static function fromRequest(Request $request): static
    {
        $toast = $request->session()->get('toast');

        return new self(
            $toast->message ?? null,
            ToastTypeEnum::tryFrom($toast->type ?? null),
            ToastPositionEnum::tryFrom($toast->position ?? null)
        );
    }

    public static function success(string $message, ToastPositionEnum $position = null): static
    {
        $position = $position ?? ToastPositionEnum::topRight();

        return new self(
            $message,
            ToastTypeEnum::success(),
            $position
        );
    }

    public static function error(string $message, ToastPositionEnum $position = null): static
    {
        $position = $position ?? ToastPositionEnum::topRight();

        return new self(
            $message,
            ToastTypeEnum::error(),
            $position
        );
    }

    public static function warning(string $message, ToastPositionEnum $position = null): static
    {
        $position = $position ?? ToastPositionEnum::topRight();

        return new self(
            $message,
            ToastTypeEnum::warning(),
            $position
        );
    }

    public static function info(string $message, ToastPositionEnum $position = null): static
    {
        $position = $position ?? ToastPositionEnum::topRight();

        return new self(
            $message,
            ToastTypeEnum::info(),
            $position
        );
    }

    /**
     * @throws Throwable
     */
    public static function handle(string $successMessage, string $errorMessage, callable $callback, array $args = []): static
    {
        DB::beginTransaction();

        try {
            call_user_func_array($callback, $args);

            DB::commit();

            return self::success($successMessage);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::emergency($exception->getMessage());
            Log::emergency($exception->getLine());
            Log::emergency($exception->getTraceAsString());

            return self::error($errorMessage);
        }
    }
}
