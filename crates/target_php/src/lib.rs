use jetted_core::target::inflect::{self, Inflector};

mod codegen;

const TYPE_INFLECTOR: inflect::CombiningInflector =
    inflect::CombiningInflector::new(inflect::Case::pascal_case());
const FIELD_INFLECTOR: inflect::TailInflector =
    inflect::TailInflector::new(inflect::Case::snake_case());
pub struct Target {}
impl Target {
    pub fn new() -> Self {
        Self {}
    }
}

impl jetted_core::target::Target for Target {
    type FileState = ();

    fn strategy(&self) -> jetted_core::target::Strategy {
        jetted_core::target::Strategy {
            file_partitioning: jetted_core::target::FilePartitioningStrategy::FilePerType(
                "php".to_owned(),
            ),
            enum_member_naming: jetted_core::target::EnumMemberNamingStrategy::Modularized,
            optional_property_handling:
                jetted_core::target::OptionalPropertyHandlingStrategy::NativeSupport,
            booleans_are_nullable: true,
            int8s_are_nullable: true,
            uint8s_are_nullable: true,
            int16s_are_nullable: true,
            uint16s_are_nullable: true,
            int32s_are_nullable: true,
            uint32s_are_nullable: true,
            float32s_are_nullable: true,
            float64s_are_nullable: true,
            strings_are_nullable: true,
            timestamps_are_nullable: true,
            arrays_are_nullable: true,
            dicts_are_nullable: true,
            aliases_are_nullable: true,
            enums_are_nullable: true,
            structs_are_nullable: true,
            discriminators_are_nullable: true,
        }
    }

    fn name(&self, kind: jetted_core::target::NameableKind, name_parts: &[String]) -> String {
        match kind {
            jetted_core::target::NameableKind::Type => TYPE_INFLECTOR.inflect(name_parts),
            jetted_core::target::NameableKind::Field => FIELD_INFLECTOR.inflect(name_parts),
            jetted_core::target::NameableKind::EnumMember => TYPE_INFLECTOR.inflect(name_parts),
        }
    }

    fn expr(
        &self,
        state: &mut Self::FileState,
        metadata: jetted_core::target::metadata::Metadata,
        expr: jetted_core::target::Expr,
    ) -> String {
        match expr {
            jetted_core::target::Expr::Empty => "",
            jetted_core::target::Expr::Boolean => "boolean",
            jetted_core::target::Expr::Int8 => "int",
            jetted_core::target::Expr::Uint8 => "int",
            jetted_core::target::Expr::Int16 => "int",
            jetted_core::target::Expr::Uint16 => "int",
            jetted_core::target::Expr::Int32 => "int",
            jetted_core::target::Expr::Uint32 => "int",
            jetted_core::target::Expr::Float32 => "float",
            jetted_core::target::Expr::Float64 => "float",
            jetted_core::target::Expr::String => "string",
            jetted_core::target::Expr::Timestamp => "",
            jetted_core::target::Expr::ArrayOf(_) => "mixed",
            jetted_core::target::Expr::DictOf(_) => "mixed",
            jetted_core::target::Expr::NullableOf(_) => "",
        }
        .to_owned()
    }

    fn item(
        &self,
        out: &mut dyn std::io::Write,
        state: &mut Self::FileState,
        item: jetted_core::target::Item,
    ) -> jetted_core::Result<Option<String>> {
        let result = match item {
            jetted_core::target::Item::Auxiliary { .. } => None,
            jetted_core::target::Item::Preamble => {
                writeln!(out, "<?php")?;
                None
            }
            jetted_core::target::Item::Postamble => None,
            jetted_core::target::Item::Struct {
                metadata,
                name,
                has_additional,
                fields,
            } => {
                writeln!(out, "final class {name} {{")?;
                for field in &fields {
                    writeln!(out, "    private ${};", field.name)?
                }
                write!(out, "\n")?;
                codegen::generate_constructor(out, 1, &fields)?;
                codegen::generate_serializer(out, 1, &fields)?;
                codegen::generate_deserializer(out, 1, &fields)?;

                writeln!(out, "}}")?;
                None
            }

            _ => None,
            /*
            jetted_core::target::Item::Alias {
                metadata,
                name,
                type_,
            } => todo!(),
            jetted_core::target::Item::Enum {
                metadata,
                name,
                members,
            } => todo!(),
            jetted_core::target::Item::Discriminator {
                metadata,
                name,
                tag_field_name,
                tag_json_name,
                variants,
            } => todo!(),
            jetted_core::target::Item::DiscriminatorVariant {
                metadata,
                name,
                parent_name,
                tag_field_name,
                tag_json_name,
                tag_value,
                has_additional,
                fields,
            } => todo!(),
             */
        };
        Ok(result)
    }
}

#[cfg(test)]
mod tests {
    mod std_tests {
        jetted_test::std_test_cases!(&crate::Target::new());
    }

    mod optional_std_tests {
        jetted_test::strict_std_test_case!(&crate::Target::new(), empty_and_nonascii_properties);

        jetted_test::strict_std_test_case!(&crate::Target::new(), empty_and_nonascii_enum_values);
    }
}
