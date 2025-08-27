# Changelog

## 0.2.0 (2025-08-27)

Full Changelog: [v0.1.1...v0.2.0](https://github.com/e-invoice-be/e-invoice-php/compare/v0.1.1...v0.2.0)

### ⚠ BREAKING CHANGES

* rename errors to exceptions
* pagination field rename, and basic streaming docs
* **refactor:** namespacing cleanup
* **refactor:** clean up pagination, errors, as well as request methods

### Features

* **client:** add streaming ([05b1eff](https://github.com/e-invoice-be/e-invoice-php/commit/05b1eff719c3724fc1f4d79c33beb224bb65a9af))
* **client:** improve error handling ([0a964b4](https://github.com/e-invoice-be/e-invoice-php/commit/0a964b44724dc37035a7dbb6a0ac41ba14c3d974))
* **client:** use named parameters in methods ([e1b2c44](https://github.com/e-invoice-be/e-invoice-php/commit/e1b2c4486c6ddf1122dd391d75a8a7f12cd619d8))
* ensure `-&gt;toArray()` benefits from structural typing ([0edf57b](https://github.com/e-invoice-be/e-invoice-php/commit/0edf57bab9faa433b9f164dd1d64a6a518fa7222))
* pagination field rename, and basic streaming docs ([11c1194](https://github.com/e-invoice-be/e-invoice-php/commit/11c11941b8a3b8c33ea13e1989aaee8932affe17))
* **php:** differentiate null and omit ([db376b7](https://github.com/e-invoice-be/e-invoice-php/commit/db376b722261d282c0a64ef09b068e738ae32d35))
* **php:** rename internal types ([3491227](https://github.com/e-invoice-be/e-invoice-php/commit/349122719a51fe48d76576c906dc4d9d887200e0))
* **refactor:** clean up pagination, errors, as well as request methods ([e61a72b](https://github.com/e-invoice-be/e-invoice-php/commit/e61a72b4a8ee8239d770f9be64bdd69458604694))
* **refactor:** namespacing cleanup ([009f98c](https://github.com/e-invoice-be/e-invoice-php/commit/009f98c7cf6548e42b1fff665a3e5c570b35d2ae))
* rename errors to exceptions ([7f7d82c](https://github.com/e-invoice-be/e-invoice-php/commit/7f7d82c0c14e4e3a734a241509a64a6561bf4475))


### Bug Fixes

* add create release workflow ([2da8d92](https://github.com/e-invoice-be/e-invoice-php/commit/2da8d92b8ae813682991e27af1a6e1e7f956ee44))
* basic pagination should work ([f09ee2c](https://github.com/e-invoice-be/e-invoice-php/commit/f09ee2c22760fcd2152daf4015b6100ae3d4ce82))
* **client:** elide null named parameters ([68d0125](https://github.com/e-invoice-be/e-invoice-php/commit/68d012510c6719ae8843e04414f9207803372163))
* minor bugs ([f0a3c9e](https://github.com/e-invoice-be/e-invoice-php/commit/f0a3c9eb4b69a52f1af4fa79d362cfc1b9c6ae98))
* streaming internals ([083ff3f](https://github.com/e-invoice-be/e-invoice-php/commit/083ff3fa2acb87f6703b62d65c55778bd35a0aec))
* Update README.md ([57a738e](https://github.com/e-invoice-be/e-invoice-php/commit/57a738e1b6095b0dcbf2195b6a1a46ad84e7524f))


### Chores

* **docs:** improve pagination examples ([ca9e9b3](https://github.com/e-invoice-be/e-invoice-php/commit/ca9e9b317502dae01309e1db4eaea2e0f4033ed8))
* **doc:** small improvement to pagination example ([ccb6fb3](https://github.com/e-invoice-be/e-invoice-php/commit/ccb6fb397ad1cd8462ca2efc1d2f4b7d523a534b))
* improve model annotations ([9445b34](https://github.com/e-invoice-be/e-invoice-php/commit/9445b340c4a174913b210183a8ce8cbff5795ea6))
* **internal:** refactored internal codepaths ([7fcbd17](https://github.com/e-invoice-be/e-invoice-php/commit/7fcbd17872b9512d7ba2f361a20b4e903938fb58))
* intuitively order union types ([887ddad](https://github.com/e-invoice-be/e-invoice-php/commit/887ddad6d446c7ad1ff1b7bd713f73c3c87cb94d))
* readme improvements ([9c71e12](https://github.com/e-invoice-be/e-invoice-php/commit/9c71e12c1889edc2e2a60e2b1843f0bd9a2e4b1a))
* remove type aliases ([94cd564](https://github.com/e-invoice-be/e-invoice-php/commit/94cd564497db34caab38f0c52db1f0ac75f0865c))

## 0.1.1 (2025-08-14)

Full Changelog: [v0.1.0...v0.1.1](https://github.com/e-invoice-be/e-invoice-php/compare/v0.1.0...v0.1.1)

### Features

* **api:** api update ([9381626](https://github.com/e-invoice-be/e-invoice-php/commit/93816266a1eb1d6a06c90f64dd849a8c52185e25))
* **client:** use with for constructors ([09dc3d7](https://github.com/e-invoice-be/e-invoice-php/commit/09dc3d71c3d1a185f8a11a28cfb01b11a7a64c66))


### Bug Fixes

* **client:** rename param to params ([0c50d33](https://github.com/e-invoice-be/e-invoice-php/commit/0c50d33d6caa934e5f4d5dcf1621dbd32b9215f4))


### Chores

* ci fixes ([1428218](https://github.com/e-invoice-be/e-invoice-php/commit/14282188a614e69e10131e030c32d16e6143b658))
* fix package name ([acd91f3](https://github.com/e-invoice-be/e-invoice-php/commit/acd91f31ceb5066a248435b5cc344a5d35555673))
* **internal:** codegen related update ([42b6411](https://github.com/e-invoice-be/e-invoice-php/commit/42b6411d16ae8be6af382f2b32359d395d850f48))
* **internal:** codegen related update ([30eb76f](https://github.com/e-invoice-be/e-invoice-php/commit/30eb76fc59d1eaee01c50a28d962b864dc343cc2))
* **internal:** update comment in script ([0529e32](https://github.com/e-invoice-be/e-invoice-php/commit/0529e32c4aab3ea1a932b145b8eb8e4b6df7e671))
* move parameters into models namespace ([b59f0dc](https://github.com/e-invoice-be/e-invoice-php/commit/b59f0dcf192a48d06debf5a33f47ed29c9c0131c))
* remove version from composer ([544edb9](https://github.com/e-invoice-be/e-invoice-php/commit/544edb9b09b1e16d178587e2d9a74cb6f336bd4b))
* update @stainless-api/prism-cli to v5.15.0 ([24797a3](https://github.com/e-invoice-be/e-invoice-php/commit/24797a38637f18a359dc10cb69072a25cef73e65))

## 0.1.0 (2025-08-05)

Full Changelog: [v0.0.1...v0.1.0](https://github.com/e-invoice-be/e-invoice-php/compare/v0.0.1...v0.1.0)

### Features

* **api:** manual updates ([1edffd1](https://github.com/e-invoice-be/e-invoice-php/commit/1edffd1c1c23324adddedffe1725745d2f767fba))
* **api:** manual updates ([8fd11e6](https://github.com/e-invoice-be/e-invoice-php/commit/8fd11e63b5d193577c3f47cc2076f778b90248ca))
* **client:** add builder methods ([f452317](https://github.com/e-invoice-be/e-invoice-php/commit/f452317be2e3f033b42e10928aa9066e5b7417d4))
* **client:** clarity improvements ([1c93039](https://github.com/e-invoice-be/e-invoice-php/commit/1c93039eafcfd22209db4822eee8efd8486c6211))
* generate default values and mark most classes as final ([d77c690](https://github.com/e-invoice-be/e-invoice-php/commit/d77c690caec65c4cee8baa3500e65aaa0967dd12))
* request methods also take nominal types ([6abbddc](https://github.com/e-invoice-be/e-invoice-php/commit/6abbddcf5c6c003b74bd3ce0e2ff5e94735789de))


### Bug Fixes

* **client:** omit optional params in constructor ([bf58139](https://github.com/e-invoice-be/e-invoice-php/commit/bf5813973dafe34b15e1a7a7948d1c55ee05ae2f))
* **client:** respect optional fields in pagination ([6cb5485](https://github.com/e-invoice-be/e-invoice-php/commit/6cb5485e73edd0eef13e113bb712e2ecb2d87636))
* correctly generate optional property attributes ([0c98e14](https://github.com/e-invoice-be/e-invoice-php/commit/0c98e143df2ef29455b264f312600ffe93a076e9))
* ensure parameter namespaced classes have correct parent namespace and name ([6c9c2dd](https://github.com/e-invoice-be/e-invoice-php/commit/6c9c2ddd7abab8d26c11eede1493bd5a23e052b8))
* move responses into own namespace ([43f9f4c](https://github.com/e-invoice-be/e-invoice-php/commit/43f9f4c9ea62debde759c63a80b5abc5c62e5449))
* parameter class nesting ([542d2e8](https://github.com/e-invoice-be/e-invoice-php/commit/542d2e898cb905efe5a54a637502bd9a7f443485))
* serialization of empty objects should result in json empty not json array ([cce7daa](https://github.com/e-invoice-be/e-invoice-php/commit/cce7daa5fd51273775984a113f4f2150611e2848))
* test discovery ([6fbbaaf](https://github.com/e-invoice-be/e-invoice-php/commit/6fbbaaf411fd82b33368bc07e369ab5646f656c1))
* Update composer.json ([0b5c881](https://github.com/e-invoice-be/e-invoice-php/commit/0b5c881d827dfddbf938ad7447a695c506ccf3dd))
* Update README.md ([cb485a4](https://github.com/e-invoice-be/e-invoice-php/commit/cb485a427a396f7ea0ab5346398a5f218dcc6e3e))
* Update README.md ([edb319e](https://github.com/e-invoice-be/e-invoice-php/commit/edb319e4def8ffde865af9549a2ad6dae63488c3))


### Chores

* add aliases for request and response shapes ([2208573](https://github.com/e-invoice-be/e-invoice-php/commit/2208573ba5b81c528ab172822a4cbfbb79ea414b))
* add codeflow ([b8f5d7d](https://github.com/e-invoice-be/e-invoice-php/commit/b8f5d7d52715230e4aa1cf9a08311da439b7dabb))
* add create releases ci ([cf1da18](https://github.com/e-invoice-be/e-invoice-php/commit/cf1da18fc2dd08ff90b69233a378fdcc106b7f17))
* add phpdoc to gitignore ([cc38c6c](https://github.com/e-invoice-be/e-invoice-php/commit/cc38c6ce32d2ef49ddf68d5323c3342d4ffc03f0))
* add phpdoc to gitignore ([afa7273](https://github.com/e-invoice-be/e-invoice-php/commit/afa727364fab7c9e3cd9841c7cad90d14e842ee0))
* annotate conversion attribute with `enum: ...` types ([ae3f34d](https://github.com/e-invoice-be/e-invoice-php/commit/ae3f34d28bbf4ae82e47670b34e741c9a11a063f))
* begin publishing flow ([c659a8e](https://github.com/e-invoice-be/e-invoice-php/commit/c659a8e01a1634de19d13ecf10098a1d06d2cc7e))
* bug fixes on model attribute ([1ab6add](https://github.com/e-invoice-be/e-invoice-php/commit/1ab6add38ab14497d02670a2bfbb2544d292e4c5))
* bug fixes on model attribute ([23e505d](https://github.com/e-invoice-be/e-invoice-php/commit/23e505d96385f4b5f28b3a295d7ce36e53d4549e))
* clean up ([aa3fcd9](https://github.com/e-invoice-be/e-invoice-php/commit/aa3fcd9767c0d6cfaa8c9703e091968f9bca57a8))
* codeflow fixes ([f4fae19](https://github.com/e-invoice-be/e-invoice-php/commit/f4fae19b567981220c59b898ee4b4664fe0113b9))
* denote enums and unions via traits ([1627121](https://github.com/e-invoice-be/e-invoice-php/commit/162712166878e7e02ba91f5e40c7b5896919c0cd))
* **docs:** clarify beta library limitations in readme ([d10c56a](https://github.com/e-invoice-be/e-invoice-php/commit/d10c56ab9507de684497820f48a414a6cdce9043))
* ensure tests are non-trivial ([254e68a](https://github.com/e-invoice-be/e-invoice-php/commit/254e68ac1323e781ac13c3699299db2a6d087ce7))
* fix some linter errors and refactor internal interfaces ([f6f4768](https://github.com/e-invoice-be/e-invoice-php/commit/f6f47689656381904ad1dfeeec16bc5ad4cb6760))
* formatting and pagination ([abc9129](https://github.com/e-invoice-be/e-invoice-php/commit/abc9129ee90f620198296bab2c18835f5c6b5b63))
* generate doc strings ([5436b8f](https://github.com/e-invoice-be/e-invoice-php/commit/5436b8f1a767d96260ec6c561f7a91f807948b58))
* generate stub union classes ([38a9978](https://github.com/e-invoice-be/e-invoice-php/commit/38a99784935460c845663240ddb5d3ada04339c0))
* ignore un-used property phpstan diagnostics ([fbb8d52](https://github.com/e-invoice-be/e-invoice-php/commit/fbb8d525c4f43a977f4bb1ed1cd08869bedf7b4b))
* improve README messaging ([6abee3e](https://github.com/e-invoice-be/e-invoice-php/commit/6abee3e2fc3331e49c4484fbf7b7aed581e93b2d))
* improve readme usage example ([ca65c8c](https://github.com/e-invoice-be/e-invoice-php/commit/ca65c8c3e6741e3d9fc22047db14621d0279a3d2))
* inline union converters ([6371d86](https://github.com/e-invoice-be/e-invoice-php/commit/6371d86d197eda215a81967decf41693e0f3249b))
* internal refactoring ([fdfd3b0](https://github.com/e-invoice-be/e-invoice-php/commit/fdfd3b05db3d145b7e55d721de0a45318469ebb4))
* **internal:** codegen related update ([23b7c2f](https://github.com/e-invoice-be/e-invoice-php/commit/23b7c2fda9a9ae6da6325204658ea184b35a5f06))
* **internal:** refactor conversion stack ([f75d240](https://github.com/e-invoice-be/e-invoice-php/commit/f75d240086225e4d50680944373c31dc8a178e21))
* minor improvements ([898ff3c](https://github.com/e-invoice-be/e-invoice-php/commit/898ff3c66cfb4c5db55d6f101c37776bd929c6b1))
* reduce param namespace nesting, and qualify models with more name info ([4ef7d04](https://github.com/e-invoice-be/e-invoice-php/commit/4ef7d040fb5d6eba051153c3c131c24773485e18))
* remove redundant final ([8d38e17](https://github.com/e-invoice-be/e-invoice-php/commit/8d38e17787d06d255415916f4527dcdf16d0f324))
* rename "serde" into "conversion" ([19c33a5](https://github.com/e-invoice-be/e-invoice-php/commit/19c33a59675709925444c7c753d78597f9112054))
* render all nested named types ([9af734d](https://github.com/e-invoice-be/e-invoice-php/commit/9af734d030686b1459dea4750413629f446f8be6))
* render all union members ([da04841](https://github.com/e-invoice-be/e-invoice-php/commit/da04841707c60f3ccc841bf77d6e6ac8e5464268))
* support datetime serialization ([4eee08a](https://github.com/e-invoice-be/e-invoice-php/commit/4eee08abfeff2ee8df3098d111880246ea457d37))
* support decoding binary streams ([bf0a5da](https://github.com/e-invoice-be/e-invoice-php/commit/bf0a5da9e49e17f8b9c661855ce3b1c094edc02d))
* support enum types via phpstan ([12da596](https://github.com/e-invoice-be/e-invoice-php/commit/12da596f2abdf18d670c6bb8ba246f02b3dd7247))
* update SDK settings ([17fe0b9](https://github.com/e-invoice-be/e-invoice-php/commit/17fe0b9a1b8f0eaf5244d9572c5621867a231462))
* update SDK settings ([c624ca0](https://github.com/e-invoice-be/e-invoice-php/commit/c624ca08f3c4eef1b7b45e3381895668c1c7624e))
* use datetime interface for date and datetime types ([9a1abbd](https://github.com/e-invoice-be/e-invoice-php/commit/9a1abbd3535f6f58f9aca63da8ab84ef9159fa16))
* use datetime interface for date and datetime types ([06adf2a](https://github.com/e-invoice-be/e-invoice-php/commit/06adf2a0159ce30bb6f3a163c59bb3ab6f1a24ff))
* use opinionated formatting rules by php-cs-fixer team ([fbfd5fd](https://github.com/e-invoice-be/e-invoice-php/commit/fbfd5fd430b05de1c0e7cd090e8ecbde42ae0c81))
* use opinionated formatting rules by php-cs-fixer team ([e55015f](https://github.com/e-invoice-be/e-invoice-php/commit/e55015fad6c21aba99d12055f7ebb37a62d96e71))


### Documentation

* note alpha status ([e1d4858](https://github.com/e-invoice-be/e-invoice-php/commit/e1d48582ce716dce54e8dec4403c187c3b8daf69))
