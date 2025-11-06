<?php
final class OptionalProperties {
    private $bar;
    private $baz;
    private $foo;

    /**
     * @param bar: mixed
     * @param baz: boolean
     * @param foo: string
     */
    public function __construct($bar, $baz, $foo) {
        $this->bar = $bar;
        $this->baz = $baz;
        $this->foo = $foo;
    }
    public function serialize() {
        $result = [];
        $result["bar"] = $this->bar;
        $result["baz"] = $this->baz;
        $result["foo"] = $this->foo;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["bar"],
            $result["baz"],
            $result["foo"]
        );
    }
}
