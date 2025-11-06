<?php
final class PropertyNameCollisions {
    private $foo;
    private $foo0;

    /**
     * @param foo: string
     * @param foo0: string
     */
    public function __construct($foo, $foo0) {
        $this->foo = $foo;
        $this->foo0 = $foo0;
    }
    public function serialize() {
        $result = [];
        $result["Foo"] = $this->foo;
        $result["foo"] = $this->foo0;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["Foo"],
            $result["foo"]
        );
    }
}
