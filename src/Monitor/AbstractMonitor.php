<?php

namespace Olla\Flow\Monitor;

abstract class AbstractMonitor implements MonitorInterface {
	abstract public function log(string $source, array $data = []);
}