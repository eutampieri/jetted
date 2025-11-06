<?php
final class EmptyAndNonasciiProperties {
    private $default_name;
    private $foo;
    private $foo0;
    private $foo1;
    private $foo_bar;
    private $foo_bar0;
    private $foo0bar;
    private $foo_bar1;

    /**
     * @param default_name: string
     * @param foo: string
     * @param foo0: string
     * @param foo1: string
     * @param foo_bar: string
     * @param foo_bar0: string
     * @param foo0bar: string
     * @param foo_bar1: string
     */
    public function __construct($default_name, $foo, $foo0, $foo1, $foo_bar, $foo_bar0, $foo0bar, $foo_bar1) {
        $this->default_name = $default_name;
        $this->foo = $foo;
        $this->foo0 = $foo0;
        $this->foo1 = $foo1;
        $this->foo_bar = $foo_bar;
        $this->foo_bar0 = $foo_bar0;
        $this->foo0bar = $foo0bar;
        $this->foo_bar1 = $foo_bar1;
    }
    public function serialize() {
        $result = [];
        $result[""] = $this->default_name;
        $result["$foo"] = $this->foo;
        $result["0foo"] = $this->foo0;
        $result["_foo"] = $this->foo1;
        $result["foo
bar"] = $this->foo_bar;
        $result["foo bar"] = $this->foo_bar0;
        $result["foo0bar"] = $this->foo0bar;
        $result["foo﷽bar"] = $this->foo_bar1;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result[""],
            $result["$foo"],
            $result["0foo"],
            $result["_foo"],
            $result["foo
bar"],
            $result["foo bar"],
            $result["foo0bar"],
            $result["foo﷽bar"]
        );
    }
}
