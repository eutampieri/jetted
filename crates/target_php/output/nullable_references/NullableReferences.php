<?php
final class NullableReferences {
    private $notnull_ref_notnull_string;
    private $notnull_ref_null_string;
    private $notnull_string;
    private $null_ref_notnull_string;
    private $null_ref_null_string;
    private $null_string;

    /**
     * @param notnull_ref_notnull_string: NotnullRefNotnullString
     * @param notnull_ref_null_string: NotnullRefNullString
     * @param notnull_string: NotnullString
     * @param null_ref_notnull_string: NullRefNotnullString
     * @param null_ref_null_string: NullRefNullString
     * @param null_string: NullString
     */
    public function __construct($notnull_ref_notnull_string, $notnull_ref_null_string, $notnull_string, $null_ref_notnull_string, $null_ref_null_string, $null_string) {
        $this->notnull_ref_notnull_string = $notnull_ref_notnull_string;
        $this->notnull_ref_null_string = $notnull_ref_null_string;
        $this->notnull_string = $notnull_string;
        $this->null_ref_notnull_string = $null_ref_notnull_string;
        $this->null_ref_null_string = $null_ref_null_string;
        $this->null_string = $null_string;
    }
    public function serialize() {
        $result = [];
        $result["notnull_ref_notnull_string"] = $this->notnull_ref_notnull_string;
        $result["notnull_ref_null_string"] = $this->notnull_ref_null_string;
        $result["notnull_string"] = $this->notnull_string;
        $result["null_ref_notnull_string"] = $this->null_ref_notnull_string;
        $result["null_ref_null_string"] = $this->null_ref_null_string;
        $result["null_string"] = $this->null_string;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["notnull_ref_notnull_string"],
            $result["notnull_ref_null_string"],
            $result["notnull_string"],
            $result["null_ref_notnull_string"],
            $result["null_ref_null_string"],
            $result["null_string"]
        );
    }
}
