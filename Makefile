#! @revision 2021-05-19 (Wed) 06:34:17
#! @brief Svelte template Makefile
# @{ Setup

SHELL = /bin/ksh
export PATH := $(PATH):$(PWD)/node_modules/.bin

all: help

# @}
# @{ Help

.PHONY: help

H_DESC = printf -- '- \E[32m%-20s\E[0m%s\n'
H_HEAD = printf -- '\n\E[2;4m%s\E[0m\n'
H_PARA = printf -- '\E[3m%s\E[0m\n'
H_RULE = printf -- '\E[2m─%.0s\E[0m' {1..20}


help:
	@$(H_HEAD) 'Build targets'
	@$(H_DESC) prod  'Build artefacts for production'
	@$(H_DESC) dev   'Build artefacts for (local) testing'
	@$(H_HEAD) 'Linting'
	@$(H_DESC) check   'Validate Svelte source files'
	@$(H_HEAD) 'Previewing'
	@$(H_DESC) preview  'Preview project locally'
	@$(H_DESC) start    'Deprecated (use preview)'
	@$(H_DESC) watch    'Deprecated (use preview)'
	@$(H_HEAD) 'Deploying'
	@$(H_PARA) 'Not yet available'
	@$(H_HEAD) 'Cleaning-up'
	@$(H_DESC) clean     'Remove temporary build files (including `docs` directory)'
	@$(H_DESC) realclean 'Extends `clean` to remove hidden and non-essential files'
	@$(H_DESC) distclean 'Extends `distclean` to remove all non-commited build dependencies '

# @}
# @{ Config

PREFLIGHT = package.json tsconfig.json

%.json: %.yaml
	@panrc -y < $^ > $@
	@[[ $(notdir $@) == package.json ]] && npm install || true

configure: preflight npm-install
	@npm update

npm-install:
	@[[ -d node_modules ]] || npm install

preflight: $(PREFLIGHT)
	-@[[ -d node_modules ]] || make configure

update-node:
	@npm cache clean -f
	@(umask 0002; sudo npm install -g n)

# @}
# @{ Build

.PHONY: build build-functions dev

dev: preflight
	@rollup -c -w

prod: NODE_ENV=production
prod: preflight
	@rollup -c


# @}
# @{ Lint

.PHONY: svelte-check

check: build
	@svelte-check


# @}
# @{ Preview

.PHONY: preflight start watch

preview: preflight
	@sirv public --no-clear

start: preview

watch: preview

# @}
# @{ Deploy

postdeploy:
	@rm -fr ./build/_redirects

# @}
# @{ Cleanup

clean:
	@[[ -d docs          ]] && rm -fr docs          || true
	@[[ -d build         ]] && rm -fr build         || true
	@[[ -f tsconfig.json ]] && rm -f  tsconfig.json || true
	@[[ -f package.json  ]] && rm -f  package.json  || true

distclean: realclean
	@[[ -d node_modules ]] && rm -rf node_modules || true

realclean: clean
	@find . -name .DS_Store -delete

# @}
# vim: fdm=marker fmr=@{,@} noet ts=4 sts=4
