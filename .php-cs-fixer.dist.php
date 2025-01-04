<?php

$finder = PhpCsFixer\Finder::create()
  ->exclude('vendors')
  ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config
  ->setRiskyAllowed(true)
  ->setIndent("  ")
  ->setRules([
    '@PHP74Migration' => true,
    '@PHP74Migration:risky' => true,
    '@PHPUnit75Migration:risky' => true,
    '@PhpCsFixer' => true,
    '@PhpCsFixer:risky' => true,
    'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']],
    'heredoc_indentation' => false,
    'modernize_strpos' => true,
    'use_arrow_functions' => false,
    'concat_space' => false,
    'binary_operator_spaces' => false,
    'operator_linebreak' => false,
    'braces_position' => false,
    'curly_braces_position' => false,
    'single_line_after_imports' => false,
    'blank_line_after_opening_tag' => false,
    'no_closing_tag' => false,
    'align_multiline_comment' => false,
    'class_attributes_separation' => false
  ])
  ->setFinder($finder);

return $config;
