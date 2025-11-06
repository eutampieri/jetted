<?php
final class TypeCollisionsFooBar0 {
    private $x;

    /**
     * @param x: string
     */
    public function __construct($x) {
        $this->x = $x;
    }
    public function serialize() {
        $result = [];
        $result["x"] = $this->x;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["x"]
        );
    }
}
