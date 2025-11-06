<?php
final class BasicProperties {
    private $bar;
    private $baz;
    private $foo;
    private $quux;

    /**
     * @param bar: string
     * @param baz: mixed
     * @param foo: boolean
     * @param quux: mixed
     */
    public function __construct($bar, $baz, $foo, $quux) {
        $this->bar = $bar;
        $this->baz = $baz;
        $this->foo = $foo;
        $this->quux = $quux;
    }
    public function serialize() {
        $result = [];
        $result["bar"] = $this->bar;
        $result["baz"] = $this->baz;
        $result["foo"] = $this->foo;
        $result["quux"] = $this->quux;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["bar"],
            $result["baz"],
            $result["foo"],
            $result["quux"]
        );
    }
}
