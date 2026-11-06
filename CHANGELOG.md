# Changelog

## [10.2.0](https://github.com/gigerIT/larapex-charts/compare/v10.1.1...v10.2.0) (2026-11-06)


### Features

* allow leaving chart.foreColor and theme.mode unset ([c0540a3](https://github.com/gigerIT/larapex-charts/commit/c0540a3aa8b7f7a89dd88b539fbb3aaa7cefa765)), closes [#9](https://github.com/gigerIT/larapex-charts/issues/9)
* update bundled ApexCharts asset to 8.7.0 ([b2e89ae](https://github.com/gigerIT/larapex-charts/commit/b2e89ae4f009cac4a07c0fb79377fefb5612e400))


### Bug Fixes

* apply setOptions() overrides to every chart output ([e83a32e](https://github.com/gigerIT/larapex-charts/commit/e83a32e7d6766a933bee60f4a6ad372820ac6347)), closes [#7](https://github.com/gigerIT/larapex-charts/issues/7) [#8](https://github.com/gigerIT/larapex-charts/issues/8)
* carry setOptions() overrides into toVue() component props ([ad00c49](https://github.com/gigerIT/larapex-charts/commit/ad00c490c88f60882caf057c229b28946f0920aa))
* correct sample content in make:chart stubs ([31b7211](https://github.com/gigerIT/larapex-charts/commit/31b7211b698a7fac1532ede1d2573a082984df12))
* emit working legend, sparkline, and font options in JSON and Vue ([4d4cc8c](https://github.com/gigerIT/larapex-charts/commit/4d4cc8c187ef026107aa4b0db381c95c02abd323))
* make generated chart classes runnable from every stub ([c39df16](https://github.com/gigerIT/larapex-charts/commit/c39df1682465bbcde6190bcb90b46fb1eaff1235))
* pin cdn() to ApexCharts 8 ([eec86f4](https://github.com/gigerIT/larapex-charts/commit/eec86f450c0b2929ae79708ab4342416eb3a069e)), closes [#10](https://github.com/gigerIT/larapex-charts/issues/10)


### Miscellaneous Chores

* enable agent project guidance ([ca069bc](https://github.com/gigerIT/larapex-charts/commit/ca069bca633551e0137ea5d0d9728527fd7cfe01))
* exclude dev tooling config from package archives ([71f37bb](https://github.com/gigerIT/larapex-charts/commit/71f37bb33e735e8500fde0d33744dc570f6e662c))

## [10.1.1](https://github.com/gigerIT/larapex-charts/compare/v10.1.0...v10.1.1) (2026-10-17)


### Bug Fixes

* remove obsolete command publish registration ([12c167a](https://github.com/gigerIT/larapex-charts/commit/12c167ad1ad2d5423d68ea8db38d5992801c2c29))
* remove obsolete command publish registration ([56eebf9](https://github.com/gigerIT/larapex-charts/commit/56eebf9ba9c39626966f2efe5b0b469ed8340123))

## [10.1.0](https://github.com/gigerIT/larapex-charts/compare/v10.0.0...v10.1.0) (2026-05-12)


### Features

* integrate Rector for automated refactoring and enhance documentation ([52cde20](https://github.com/gigerIT/larapex-charts/commit/52cde20083eee891c3c1c1d915c58b0800e0282f))


### Bug Fixes

* stop forcing release please version ([7113280](https://github.com/gigerIT/larapex-charts/commit/71132809474b3ffe0f9719f55537de20655a9278))


### Miscellaneous Chores

* add phpstan level 1 setup ([f40495a](https://github.com/gigerIT/larapex-charts/commit/f40495ae40e8b3a17b52e9d913b66796ebc8557b))
* integrate PHPStan into CI workflow and update AGENTS.md documentation ([c2b8b26](https://github.com/gigerIT/larapex-charts/commit/c2b8b26f0c4f766b4a52bbf36e3c7a669be01f8c))
* raise phpstan to level 2 ([c009360](https://github.com/gigerIT/larapex-charts/commit/c00936064a37813d5b8ef6b23208c95704ff9117))
* raise phpstan to level 3 ([7db2411](https://github.com/gigerIT/larapex-charts/commit/7db241154fa8983be8a9ad60ae9069935f0f59c4))
* raise phpstan to level 4 ([7fbd3d3](https://github.com/gigerIT/larapex-charts/commit/7fbd3d3c88ae834aaf30574f436a6441231aee38))
* raise phpstan to level 5 ([6ed0c1a](https://github.com/gigerIT/larapex-charts/commit/6ed0c1a76c4a0b75c0d75796c264a85110ede92e))
* raise phpstan to level 6 ([89037af](https://github.com/gigerIT/larapex-charts/commit/89037af858eb330ab39cf421225fd409e0944d08))
* raise phpstan to level 7 ([8ae1714](https://github.com/gigerIT/larapex-charts/commit/8ae17144552e727a57a42cc24cd8713fd71d4e5f))
* raise phpstan to level 8 ([0e12766](https://github.com/gigerIT/larapex-charts/commit/0e12766245e1ab38246dab3e2e96be096fca66d1))

## [10.0.0](https://github.com/gigerIT/larapex-charts/compare/v9.0.1...v10.0.0) (2026-05-12)


### Features

* add laravel boost skill for Larapex Charts development guidelines and usage examples ([aba60cf](https://github.com/gigerIT/larapex-charts/commit/aba60cf3b2818b5090e0d0ebb2205f43822bd782))
* laravel 13 support ([c50fb88](https://github.com/gigerIT/larapex-charts/commit/c50fb88b4fe7d1530fed3f651e813c30affb3f05))


### Miscellaneous Chores

* Add .gitattributes and update .gitignore for improved project structure; introduce AGENTS.md for project documentation and update composer.json and README.md for new maintainer details. ([4eda21b](https://github.com/gigerIT/larapex-charts/commit/4eda21b2fc4935f6f354b10d6d403ffd0254c38c))
* add Release Please configuration files for automated release management ([b532977](https://github.com/gigerIT/larapex-charts/commit/b532977ac78468fe2c96472df04e78fbd47806e9))
* exclude agent guidance from package archives ([701bbac](https://github.com/gigerIT/larapex-charts/commit/701bbacf04504fb03a4c97e1bc89eb6301492fc5))
* Remove deprecated PHPUnit configuration and IDE files, along with cache and log files to clean up the project structure. ([94c8357](https://github.com/gigerIT/larapex-charts/commit/94c8357159a266a42c7a6b57e78e48b3e0bf0df4))
* update AGENTS.md to ensure README.md reflects user-facing changes and maintain accuracy ([6b5f074](https://github.com/gigerIT/larapex-charts/commit/6b5f0741b92f37d313c693095d230b1e07242e6d))
* update CI configuration and dependencies for PHP and Laravel compatibility ([ff619ba](https://github.com/gigerIT/larapex-charts/commit/ff619ba2c5fd27c240f5575e6b50022876fe026b))
* update CI configuration and README for improved clarity and maintenance details ([fa5a814](https://github.com/gigerIT/larapex-charts/commit/fa5a814c94642aeaf318b71cdc65265736deeaa6))
* update README.md to enhance badge display with improved styling and links ([319c60e](https://github.com/gigerIT/larapex-charts/commit/319c60ece168b17b64a0769944e663231a58f598))
