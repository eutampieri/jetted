pub struct Target {}
impl Target {
    pub fn new() -> Self {
        Self {}
    }
}

impl jetted_core::target::Target for Target {
    type FileState = ();

    fn strategy(&self) -> jetted_core::target::Strategy {
        todo!()
    }

    fn name(&self, kind: jetted_core::target::NameableKind, name_parts: &[String]) -> String {
        todo!()
    }

    fn expr(&self, state: &mut Self::FileState, metadata: jetted_core::target::metadata::Metadata, expr: jetted_core::target::Expr) -> String {
        todo!()
    }

    fn item(
        &self,
        out: &mut dyn std::io::Write,
        state: &mut Self::FileState,
        item: jetted_core::target::Item,
    ) -> jetted_core::Result<Option<String>> {
        todo!()
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

