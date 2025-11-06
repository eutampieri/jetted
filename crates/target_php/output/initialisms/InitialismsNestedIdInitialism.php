<?php
final class InitialismsNestedIdInitialism {
    private $json;
    private $normalword;

    /**
     * @param json: string
     * @param normalword: string
     */
    public function __construct($json, $normalword) {
        $this->json = $json;
        $this->normalword = $normalword;
    }
    public function serialize() {
        $result = [];
        $result["json"] = $this->json;
        $result["normalword"] = $this->normalword;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["json"],
            $result["normalword"]
        );
    }
}
