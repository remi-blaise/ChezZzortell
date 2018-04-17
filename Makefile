.PHONY: build watch

build:
	-rm build/*
	sass --update --sourcemap=none sass:build

watch:
	sass --watch --sourcemap=none sass:build
