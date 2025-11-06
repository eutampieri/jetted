use jetted_core::target::Field;

fn nest(nesting_level: u8) -> String {
    "    ".repeat(nesting_level.into())
}

macro_rules! nested_writeln {
    ($stream:expr, $nl:expr, $fmt:expr $(, $arg:expr)*) => {{
        write!($stream, "{}", nest($nl))?;
        writeln!($stream, $fmt $(, $arg)*)?;
        Ok::<(), std::io::Error>(())
    }};
}
fn doc_comment(
    out: &mut dyn std::io::Write,
    nesting_level: u8,
    fields: &[Field],
) -> std::io::Result<()> {
    nested_writeln!(out, nesting_level, "/**")?;
    for field in fields {
        nested_writeln!(
            out,
            nesting_level,
            " * @param {}: {}",
            field.name,
            field.type_
        )?;
    }
    nested_writeln!(out, nesting_level, " */")?;

    Ok(())
}
pub fn generate_constructor(
    out: &mut dyn std::io::Write,
    nesting_level: u8,
    fields: &[Field],
) -> std::io::Result<()> {
    doc_comment(out, nesting_level, fields)?;
    nested_writeln!(
        out,
        nesting_level,
        "public function __construct({}) {{",
        fields
            .iter()
            .map(|x| format!("${}", x.name))
            .collect::<Vec<_>>()
            .join(", ")
    )?;
    for field in fields {
        nested_writeln!(out, nesting_level + 1, "$this->{0} = ${0};", field.name)?;
    }
    nested_writeln!(out, nesting_level, "}}")?;
    Ok(())
}

pub fn generate_serializer(
    out: &mut dyn std::io::Write,
    nesting_level: u8,
    fields: &[Field],
) -> std::io::Result<()> {
    nested_writeln!(out, nesting_level, "public function serialize() {{")?;
    nested_writeln!(out, nesting_level + 1, "$result = [];")?;

    for field in fields {
        nested_writeln!(
            out,
            nesting_level + 1,
            "$result[\"{}\"] = $this->{};",
            field.json_name,
            field.name
        )?;
    }
    nested_writeln!(out, nesting_level + 1, "return $result;")?;
    nested_writeln!(out, nesting_level, "}}")?;
    Ok(())
}

pub fn generate_deserializer(
    out: &mut dyn std::io::Write,
    nesting_level: u8,
    fields: &[Field],
) -> std::io::Result<()> {
    nested_writeln!(
        out,
        nesting_level,
        "public static function deserialize($data) {{"
    )?;

    nested_writeln!(out, nesting_level + 1, "return new self(")?;
    for (i, field) in fields.into_iter().enumerate() {
        let separator = if i == fields.len() - 1 { "" } else { "," };
        nested_writeln!(
            out,
            nesting_level + 2,
            "$data[\"{}\"]{}",
            field.json_name,
            separator
        )?;
    }
    nested_writeln!(out, nesting_level + 1, ");")?;
    nested_writeln!(out, nesting_level, "}}")?;
    Ok(())
}

pub fn generate_getters(
    out: &mut dyn std::io::Write,
    nesting_level: u8,
    fields: &[Field],
) -> std::io::Result<()> {
    for field in fields {
        nested_writeln!(
            out,
            nesting_level,
            "public function get_{}() {{",
            field.name
        )?;
        nested_writeln!(out, nesting_level + 1, "return $this->{};", field.name)?;
        nested_writeln!(out, nesting_level, "}}")?;
    }
    Ok(())
}
