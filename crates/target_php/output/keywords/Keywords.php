<?php
final class Keywords {
    private $for;
    private $object;

    /**
     * @param for: For
     * @param object: Object
     */
    public function __construct($for, $object) {
        $this->for = $for;
        $this->object = $object;
    }
    public function serialize() {
        $result = [];
        $result["for"] = $this->for;
        $result["object"] = $this->object;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["for"],
            $result["object"]
        );
    }
}
