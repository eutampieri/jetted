<?php
final class NullableTimestampProperty {
    private $foo;

    /**
     * @param foo: 
     */
    public function __construct($foo) {
        $this->foo = $foo;
    }
    public function serialize() {
        $result = [];
        $result["foo"] = $this->foo;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["foo"]
        );
    }
}
