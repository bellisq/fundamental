<?php

namespace Bellisq\Fundamental;

use Bellisq\Fundamental\Basics\BasicInternalServiceContainer;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\TypeMap\Utility\FiniteTypeMapAggregate;
use Bellisq\TypeMap\Utility\ObjectContainer;
use ErrorException;
use LogicException;
use Throwable;


abstract class Application
{
    protected function getInternalServiceContainerName(): string
    {
        return BasicInternalServiceContainer::class;
    }

    /**
     * Notify user an error occurred.
     *
     * Do not care about logging. It will be automatically done.
     *
     * @param Throwable $r
     */
    abstract protected function onError(Throwable $r): void;

    abstract protected function process(): string;

    protected $fundamentalContainer;
    protected $serviceContainer;
    protected $modelInstantiator;

    protected function __construct(RootDirectory $rDir, LogDirectory $lDir)
    {
        $tBegin = microtime(true);
        set_error_handler(function (
            $errorNo, $errorString, $errorFile, $errorLine
        ): void {
            throw new ErrorException(
                $errorString,
                0,
                $errorNo,
                $errorFile,
                $errorLine
            );
        });
        try {
            $iscName = $this->getInternalServiceContainerName();
            if (!is_a($iscName, BasicInternalServiceContainer::class, true))
                throw new LogicException('Internal Service Container must be a subclass of BasicInternalServiceContainer.');

            /** @var BasicInternalServiceContainer $isc */
            $isc = new $iscName($rDir, $lDir);
            $logger = $isc->logger;

            try {
                $sCon = new ServiceContainer($isc);
                $mIns = new ModelInstantiator(new FiniteTypeMapAggregate($isc, $sCon), true);

                $this->fundamentalContainer = $isc;
                $this->serviceContainer = $sCon;
                $this->modelInstantiator = $mIns;

                $name = $this->process();

                $time = microtime(true) - $tBegin;

                $logger->info("{$name}; Time: {$time}s");
                if ($time >= 1.0) {
                    $logger->alert("Slow Response (Time >= 1.0s)");
                }
            } catch (Throwable $t) {
                $this->onError($t);
                $logger->emergency($t);
                $logger->emergency(
                    str_replace(
                        "\n",
                        "\\n",
                        str_replace("\r\n", "\n", print_r($t, true))
                    )
                );
                die;
            }
        } catch (Throwable $t) {
            $this->onError($t);
            error_log($t);
            error_log(print_r($t, true));
            die;
        }
    }
}