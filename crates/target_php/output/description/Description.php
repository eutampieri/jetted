<?php
final class Description {
    private $discriminator_with_description;
    private $enum_with_description;
    private $long_description;
    private $properties_with_description;
    private $ref_with_description;
    private $string_with_description;

    /**
     * @param discriminator_with_description: DescriptionDiscriminatorWithDescription
     * @param enum_with_description: DescriptionEnumWithDescription
     * @param long_description: string
     * @param properties_with_description: DescriptionPropertiesWithDescription
     * @param ref_with_description: Baz
     * @param string_with_description: string
     */
    public function __construct($discriminator_with_description, $enum_with_description, $long_description, $properties_with_description, $ref_with_description, $string_with_description) {
        $this->discriminator_with_description = $discriminator_with_description;
        $this->enum_with_description = $enum_with_description;
        $this->long_description = $long_description;
        $this->properties_with_description = $properties_with_description;
        $this->ref_with_description = $ref_with_description;
        $this->string_with_description = $string_with_description;
    }
    public function serialize() {
        $result = [];
        $result["discriminator_with_description"] = $this->discriminator_with_description;
        $result["enum_with_description"] = $this->enum_with_description;
        $result["long_description"] = $this->long_description;
        $result["properties_with_description"] = $this->properties_with_description;
        $result["ref_with_description"] = $this->ref_with_description;
        $result["string_with_description"] = $this->string_with_description;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["discriminator_with_description"],
            $result["enum_with_description"],
            $result["long_description"],
            $result["properties_with_description"],
            $result["ref_with_description"],
            $result["string_with_description"]
        );
    }
}
