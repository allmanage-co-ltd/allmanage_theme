.DEFAULT_GOAL := help

.PHONY: help
help: ## Show this help
	@echo "Usage: make [target] [options]"
	@echo ""
	@echo "Targets:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}'

.PHONY: i
i: ##
	@composer install

.PHONY: i-82
i-82: ##
	@php8.2 /usr/bin/composer install

.PHONY: gen
gen: ## Generate class file ( make gen dir=Hook name=Test )
	@test -n "$(dir)" || (echo "Error: dir required" && exit 1)
	@test -n "$(name)" || (echo "Error: name required" && exit 1)
	@mkdir -p app/$(dir)
	@echo "<?php" > app/$(dir)/$(name).php
	@echo "" >> app/$(dir)/$(name).php
	@echo "namespace App\\$(dir);" >> app/$(dir)/$(name).php
	@echo "" >> app/$(dir)/$(name).php
	@echo "/**-----------------------------------" >> app/$(dir)/$(name).php
	@echo " * $(name)" >> app/$(dir)/$(name).php
	@echo " *----------------------------------*/" >> app/$(dir)/$(name).php
	@echo "class $(name) extends $(dir)" >> app/$(dir)/$(name).php
	@echo "{" >> app/$(dir)/$(name).php
	@echo "  public function __construct() {}" >> app/$(dir)/$(name).php
	@echo "" >> app/$(dir)/$(name).php
	@echo "  /**" >> app/$(dir)/$(name).php
	@echo "   *" >> app/$(dir)/$(name).php
	@echo "   */" >> app/$(dir)/$(name).php
	@echo "  public function boot(): void" >> app/$(dir)/$(name).php
	@echo "  {" >> app/$(dir)/$(name).php
	@echo "    //" >> app/$(dir)/$(name).php
	@echo "  }" >> app/$(dir)/$(name).php
	@echo "}" >> app/$(dir)/$(name).php
	@echo "✓ Created app/$(dir)/$(name).php"