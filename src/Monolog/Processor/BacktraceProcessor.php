<?php declare(strict_types=1);

/*
 * This file is part of the Monolog Extensions package.
 *
 * (c) Cristiano Soares <crisnao2@yahoo.com.br>
 */

namespace MonologExtensions\Processor;

use Monolog\Processor\ProcessorInterface;

/**
 * Injects backtrace in all records
 */
class BacktraceProcessor implements ProcessorInterface
{
    /**
     * @var int $backtraceDepthLimit depth limit for backtrace
     */
    private int $backtraceDepthLimit;

    /**
     * @param int $backtraceDepthLimit depth limit for backtrace
     */
    public function __construct(int $backtraceDepthLimit = 6)
    {
        $this->backtraceDepthLimit = $backtraceDepthLimit;
    }

    /**
     * called by Monolog processor
     *
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        $debugTraces = debug_backtrace();

        if ($debugTraces) {
            $traces = [];
            $traceDepthCount = 0;

            foreach ($debugTraces as $debugTrace) {
                if ($debugTrace['function'] == '__invoke') {
                    continue;
                }

                if ($debugTrace['function'] == 'addRecord') {
                    continue;
                }

                $traces[] = [
                    'function' => $debugTrace['function'],
                    'file' => ($debugTrace['file'] ?? 'file not defined'),
                    'line' => ($debugTrace['line'] ?? 'line not defined'),
                ];

                if ($traceDepthCount >= $this->backtraceDepthLimit) {
                    break;
                }

                $traceDepthCount++;
            }

            $record['extra']['backtrace'] = $traces;
        }

        return $record;
    }
}
