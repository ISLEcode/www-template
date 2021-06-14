#! @revision 2021-06-14 (Mon) 10:27:02
#! @brief Svelte template Makefile
# @{ Setup

SHELL = /bin/ksh
HOME_URL = /docs/sampler.html

export PATH := $(PATH):$(PWD)/node_modules/.bin

WWW_FOLDER  = qrcode
WWW_SOURCES = .env* composer.* docs lib vendor
WWW_TARBALL = website.tgz
WWW_TOPDIR  = /var/sandbox
WWW_USEROWN = centurion:ait-wheel
WWW_WEBSITE = https://dusaasp1.isle.plus/qrcode/

all: help

# @}
# @{ Help

.PHONY: help

H_DESC = printf -- '- \E[32m%-20s\E[0m%s\n'
H_ITEM = printf -- '- \E[3m%s\E[0m\n'
H_HEAD = printf -- '\n\E[2;4m%s\E[0m\n'
H_PARA = printf -- '\E[3m%s\E[0m\n'
H_RULE = printf -- '\E[2m─%.0s\E[0m' {1..20}


help:
	@$(H_HEAD) 'Configuring'
	@$(H_DESC) configure      'Configure this repository for builds'
	@$(H_DESC) get-npm        'Update `npm` to its latest version'
	@$(H_DESC) package        'Generate `package.json` from `package.yaml`'
	@$(H_DESC) tsconfig       'Generate `tsconfig.json` from `tsconfig.yaml`'
	@$(H_HEAD) 'Building'
	@$(H_DESC) prod           'Build artefacts for production'
	@$(H_DESC) dev            'Build artefacts for (local) testing'
	@$(H_HEAD) 'Linting'
	@$(H_DESC) check          'Validate Svelte source files'
	@$(H_HEAD) 'Previewing'
	@$(H_DESC) preview        'Preview project locally'
	@$(H_DESC) start          'Deprecated (use preview)'
	@$(H_DESC) watch          'Deprecated (use preview)'
	@$(H_HEAD) 'Deploying'
	@$(H_PARA) 'Not yet available'
	@$(H_HEAD) 'Cleaning-up'
	@$(H_DESC) clean          'Remove temporary build files (including `docs` directory)'
	@$(H_DESC) realclean      'Extends `clean` to remove hidden and non-essential files'
	@$(H_DESC) distclean      'Extends `distclean` to remove all non-commited build dependencies '

# @}
# @{ Config

.PHONY: configure npm-install package preflight tsconfig get-npm

PREFLIGHT = package.json tsconfig.json

%.json: %.yaml
	@panrc -y < $^ > $@
	@[[ $(notdir $@) == package.json ]] && npm install || true

configure: preflight npm-install
	@npm update

get-npm:
	@npm cache clean -f
	@(umask 0002; sudo npm install -g n)

npm-install:
	@[[ -d node_modules ]] || npm install

package: package.json

preflight: $(PREFLIGHT)

package: package.json

# @}
# @{ Build

.PHONY: build build-functions dev www

dev: preflight www
	@$(H_ITEM) 'Building application in dev mode'
	@rollup -c -w

prod: NODE_ENV=production
prod: preflight www
	@$(H_ITEM) 'Building application for production'
	@rollup -c

www:
	@$(H_ITEM) 'Populating static files'
	@[[ -d docs ]] || mkdir docs; true
	@[[ -d docs/zip/app/js       ]] || mkdir -p docs/zip/app/js; true
	@[[ -d docs/zip/app/js/fonts ]] || cp -R node_modules/bootstrap-icons/font/fonts docs/zip/app/js; true
	@[[ -f docs/zip/app/js/bootstrap.min.css.map ]] || cp node_modules/bootstrap5/dist/css/bootstrap.min.css.map docs/zip/app/js/
	@(cd www; tar cf - *) | (cd docs; tar xf -)

# @}
# @{ Lint

.PHONY: svelte-check

check: build
	@svelte-check


# @}
# @{ Testing

.PHOTY: test

test:
	@jest

# @}
# @{ Preview

.PHONY: preflight start watch

preview: preflight
	@sirv docs --single --no-clear

open: preflight
	@typeset -l url=http://localhost/$(PWD:$(HOME)/%=%)$(HOME_URL); open $$url

start: preview

watch: preview

# @}
# @{ Deploy

deploy: prod tarball
	@$(H_ITEM) 'Building distribution tarball'
	@umask  0007; scp $(WWW_TARBALL) centos8:
	@ssh centos8 'umask 0007; \
		cd $(WWW_TOPDIR); \
		sudo tar xf ~/$(WWW_TARBALL) -m; \
		sudo chown -R $(WWW_USEROWN) $(WWW_FOLDER); \
		sudo cat $(WWW_FOLDER)/sql/testdata.sql | mysql -uroot -p'Widenius1995!'; \
		rm ~/$(WWW_TARBALL)'

MYSQLDUMP = mysqldump --single-transaction -u root --databases --add-drop-database
tarball: $(WWW_SOURCES)
	@$(H_ITEM) 'Deploying build to production'
	@[[ -d $(WWW_FOLDER)  ]] && rm -rf $(WWW_FOLDER); true
	@[[ -f $(WWW_TARBALL) ]] && rm -rf $(WWW_TARBALL); true
	@umask 0007; mkdir -p $(WWW_FOLDER)/sql
	@umask 0007; cp -R $(WWW_SOURCES) $(WWW_FOLDER)/
	@umask 0007; cd $(WWW_FOLDER); cp .env.centos8 .env; cd docs; mv sampler.html index.html
	@echo "umask 0007; $(MYSQLDUMP) gp_config gp_patinfo > $(WWW_FOLDER)/sql/testdata.sql"
	@umask 0007; tar zcf $(WWW_TARBALL) $(WWW_FOLDER)

website:
	@open -g $(WWW_WEBSITE)

postdeploy:
	@rm -fr ./build/_redirects

# @}
# @{ Cleanup

clean:
	@$(H_ITEM) 'Removing temporary build files (including `docs` directory)'
	@[[ -d docs          ]] && rm -fr docs          || true
	@[[ -d build         ]] && rm -fr build         || true
	@[[ -f tsconfig.json ]] && rm -f  tsconfig.json || true
	@[[ -f package.json  ]] && rm -f  package.json  || true

distclean: realclean
	@$(H_ITEM) 'Removing all non-commited build dependencies '
	@[[ -d node_modules ]] && rm -rf node_modules || true

realclean: clean
	@$(H_ITEM) 'Removing hidden and non-essential files'
	@find . -name .DS_Store -delete

# @}
# vim: fdm=marker fmr=@{,@} noet ts=4 sts=4
