<?php
final class CustomOverrides {
    private $override_elements_container;
    private $override_type_discriminator;
    private $override_type_enum;
    private $override_type_expr;
    private $override_type_properties;
    private $override_values_container;

    /**
     * @param override_elements_container: mixed
     * @param override_type_discriminator: CustomOverridesOverrideTypeDiscriminator
     * @param override_type_enum: CustomOverridesOverrideTypeEnum
     * @param override_type_expr: string
     * @param override_type_properties: CustomOverridesOverrideTypeProperties
     * @param override_values_container: mixed
     */
    public function __construct($override_elements_container, $override_type_discriminator, $override_type_enum, $override_type_expr, $override_type_properties, $override_values_container) {
        $this->override_elements_container = $override_elements_container;
        $this->override_type_discriminator = $override_type_discriminator;
        $this->override_type_enum = $override_type_enum;
        $this->override_type_expr = $override_type_expr;
        $this->override_type_properties = $override_type_properties;
        $this->override_values_container = $override_values_container;
    }
    public function serialize() {
        $result = [];
        $result["override_elements_container"] = $this->override_elements_container;
        $result["override_type_discriminator"] = $this->override_type_discriminator;
        $result["override_type_enum"] = $this->override_type_enum;
        $result["override_type_expr"] = $this->override_type_expr;
        $result["override_type_properties"] = $this->override_type_properties;
        $result["override_values_container"] = $this->override_values_container;
        return json_encode($result);
    }
    public static function deserialize($data) {
        return new self(
            $result["override_elements_container"],
            $result["override_type_discriminator"],
            $result["override_type_enum"],
            $result["override_type_expr"],
            $result["override_type_properties"],
            $result["override_values_container"]
        );
    }
}
