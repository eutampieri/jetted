<?php
final class EnumCollisionsFoo {
    private $bar;

    /**
     * @param bar: EnumCollisionsFooBar
     */
    public function __construct($bar) {
        $this->bar = $bar;
    }
    public function serialize() {
        $result = [];
        $result["bar"] = $this->bar;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["bar"]
        );
    }
}
