# Changelog

## 4.1.1

No changes detected.

## 4.1.0

* `sdk->assessments->create()`:  `response.authContext` **Added**
* `sdk->assessments->get()`:  `response.authContext` **Added**
* `sdk->assessments->query()`:  `response.items[]->authContext` **Added**

## 4.0.3

No changes detected.

## 4.0.2

No changes detected.

## 4.0.1

No changes detected.

## 4.0.0

* `sdk->keys->rotate()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->create()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->rotate()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->recordOutcome()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->list()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->create()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->query()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->delete()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->get()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->list()`: **Added**
* `sdk->webhookendpoints->create()`: **Added**
* `sdk->webhookendpoints->sendTestEvent()`: **Added**
* `sdk->webhookendpoints->rotateSigningKey()`: **Added**
* `sdk->webhookendpoints->delete()`: **Added**

## 3.0.0

* `sdk->assessments->create()`:  `error.code->enum(tooManyIntegrations)` **Added** (Breaking ⚠️)
* `sdk->assessments->get()`:  `error.code->enum(tooManyIntegrations)` **Added** (Breaking ⚠️)
* `sdk->assessments->recordOutcome()`:  `error.code->enum(tooManyIntegrations)` **Added** (Breaking ⚠️)
* `sdk->assessments->query()`:  `error.code->enum(tooManyIntegrations)` **Added** (Breaking ⚠️)
* `sdk->keys->rotate()`: 
  *  `response.scopes[]->enum(integrations)` **Added** (Breaking ⚠️)
  *  `error.code->enum(tooManyIntegrations)` **Added** (Breaking ⚠️)
* `sdk->integrations->create()`: **Added**
* `sdk->integrations->list()`: **Added**
* `sdk->integrations->delete()`: **Added**
* `sdk->integrations->rotate()`: **Added**

## 2.0.20

* `sdk->assessments->create()`: 
  *  `request.body->issuedCredential` **Added**
  *  `response.risk` **Changed**
* `sdk->assessments->get()`:  `response.risk` **Changed**
* `sdk->assessments->query()`:  `response.items[]->risk` **Changed**

## 2.0.19

No changes detected.

## 2.0.18

No changes detected.

## 2.0.17

* `sdk->assessments->create()`: 
  *  `request.body->authContext` **Changed**

## 2.0.16

No changes detected.

## 2.0.15

No changes detected.

## 2.0.14

No changes detected.

## 2.0.13

No changes detected.

## 2.0.12

No changes detected.

## 2.0.11

No changes detected.

## 2.0.10

No changes detected.

## 2.0.9

No changes detected.

## 2.0.8

No changes detected.

## 2.0.7

No changes detected.

## 2.0.6

No changes detected.

## 2.0.5

No changes detected.

## 2.0.4

No changes detected.

## 2.0.3

No changes detected.

## 2.0.2

API changes since the previous release are not listed: no earlier document was recorded.
