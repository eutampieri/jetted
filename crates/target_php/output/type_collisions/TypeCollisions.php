<?php
final class TypeCollisions {
    private $foo;
    private $foo_bar;

    /**
     * @param foo: TypeCollisionsFoo
     * @param foo_bar: TypeCollisionsFooBar0
     */
    public function __construct($foo, $foo_bar) {
        $this->foo = $foo;
        $this->foo_bar = $foo_bar;
    }
    public function serialize() {
        $result = [];
        $result["foo"] = $this->foo;
        $result["foo_bar"] = $this->foo_bar;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["foo"],
            $result["foo_bar"]
        );
    }
}
