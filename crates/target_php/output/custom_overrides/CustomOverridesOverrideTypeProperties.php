<?php
final class CustomOverridesOverrideTypeProperties {

    /**
     */
    public function __construct() {
    }
    public function serialize() {
        $result = [];
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
        );
    }
}
