<?php

namespace Olla\Flow\Security\Credential;

abstract class AbstractCredential implements CredentialInterface {
	abstract public function getUser();
}