<?php
final class Initialisms {
    private $http;
    private $id;
    private $nested_id_initialism;
    private $utf8;
    private $word_with_embedded_id_initialism;
    private $word_with_trailing_initialism_id;

    /**
     * @param http: string
     * @param id: string
     * @param nested_id_initialism: InitialismsNestedIdInitialism
     * @param utf8: string
     * @param word_with_embedded_id_initialism: string
     * @param word_with_trailing_initialism_id: string
     */
    public function __construct($http, $id, $nested_id_initialism, $utf8, $word_with_embedded_id_initialism, $word_with_trailing_initialism_id) {
        $this->http = $http;
        $this->id = $id;
        $this->nested_id_initialism = $nested_id_initialism;
        $this->utf8 = $utf8;
        $this->word_with_embedded_id_initialism = $word_with_embedded_id_initialism;
        $this->word_with_trailing_initialism_id = $word_with_trailing_initialism_id;
    }
    public function serialize() {
        $result = [];
        $result["http"] = $this->http;
        $result["id"] = $this->id;
        $result["nested_id_initialism"] = $this->nested_id_initialism;
        $result["utf8"] = $this->utf8;
        $result["word_with_embedded_id_initialism"] = $this->word_with_embedded_id_initialism;
        $result["word_with_trailing_initialism_id"] = $this->word_with_trailing_initialism_id;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["http"],
            $result["id"],
            $result["nested_id_initialism"],
            $result["utf8"],
            $result["word_with_embedded_id_initialism"],
            $result["word_with_trailing_initialism_id"]
        );
    }
}
