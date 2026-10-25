# Changelog

## 7.2.6

* `sdk->integrations->create()`: 
  *  `request->platform->enum(supabase)` **Added**
  *  `response.platform->enum(supabase)` **Added**
* `sdk->integrations->list()`:  `response.items[]->platform->enum(supabase)` **Added**
* `sdk->integrations->rotate()`:  `response.platform->enum(supabase)` **Added**

## 7.2.5

* `sdk->assessments->create()`:  `response.account->risk->reasons[]->code` **Changed**
* `sdk->assessments->get()`:  `response.account->risk->reasons[]->code` **Changed**
* `sdk->assessments->query()`:  `response.items[]->risk->reasons[]->code` **Changed**
* `sdk->accounts->listChanged()`:  `response.items[]->risk->reasons[]->code` **Changed**
* `sdk->accounts->get()`:  `response.risk->reasons[]->code` **Changed**
* `sdk->accounts->listAssessments()`:  `response.items[]->risk->reasons[]->code` **Changed**

## 7.2.4

No changes detected.

## 7.2.3

No changes detected.

## 7.2.2

No changes detected.

## 7.2.1

* `sdk->accounts->recordEnforcement()`: 
  *  `request.body->action->enum(activate)` **Added**
  *  `response.action->enum(activate)` **Added**

## 7.2.0

* `sdk->keys->create()`: **Added**
* `sdk->keys->list()`: **Added**
* `sdk->keys->revoke()`: **Added**
* `sdk->settings->get()`: **Added**
* `sdk->settings->update()`: **Added**
* `sdk->assessments->create()`:  `error.code` **Changed**
* `sdk->assessments->get()`:  `error.code` **Changed**
* `sdk->assessments->delete()`:  `error.code` **Changed**
* `sdk->assessments->recordOutcome()`:  `error.code` **Changed**
* `sdk->assessments->query()`:  `error.code` **Changed**
* `sdk->accounts->listChanged()`:  `error.code` **Changed**
* `sdk->accounts->get()`:  `error.code` **Changed**
* `sdk->accounts->delete()`:  `error.code` **Changed**
* `sdk->accounts->listAssessments()`:  `error.code` **Changed**
* `sdk->accounts->recordEnforcement()`:  `error.code` **Changed**
* `sdk->keyusage->record()`:  `error.code` **Changed**
* `sdk->keys->rotate()`: 
  *  `response.scopes[]->enum(management)` **Added**
  *  `error.code` **Changed**
* `sdk->integrations->create()`:  `error.code` **Changed**
* `sdk->integrations->list()`:  `error.code` **Changed**
* `sdk->integrations->delete()`:  `error.code` **Changed**
* `sdk->integrations->rotate()`:  `error.code` **Changed**
* `sdk->webhookendpoints->list()`:  `error.code` **Changed**
* `sdk->webhookendpoints->create()`:  `error.code` **Changed**
* `sdk->webhookendpoints->delete()`:  `error.code` **Changed**
* `sdk->webhookendpoints->rotateSigningKey()`:  `error.code` **Changed**
* `sdk->webhookendpoints->sendTestEvent()`:  `error.code` **Changed**
* `sdk->webhookendpoints->listDeliveries()`:  `error.code` **Changed**
* `sdk->webhookendpoints->replayDelivery()`:  `error.code` **Changed**

## 7.1.0

No changes detected.

## 15.0.3

No changes detected.

## 15.0.2

No changes detected.

## 15.0.1

No changes detected.

## 15.0.0

* `sdk->assessments->create()`:  `response.account->risk->reasons[]->code` **Changed** (Breaking ⚠️)
* `sdk->assessments->get()`:  `response.account->risk->reasons[]->code` **Changed** (Breaking ⚠️)
* `sdk->assessments->query()`:  `response.items[]->risk->reasons[]->code` **Changed** (Breaking ⚠️)
* `sdk->accounts->listChanged()`:  `response.items[]->risk->reasons[]->code` **Changed** (Breaking ⚠️)
* `sdk->accounts->get()`:  `response.risk->reasons[]->code` **Changed** (Breaking ⚠️)
* `sdk->accounts->listAssessments()`:  `response.items[]->risk->reasons[]->code` **Changed** (Breaking ⚠️)

## 14.0.0

* `sdk->assessments->create()`:  `response.detail->incompleteSources[]->lane->enum(domain)` **Added** (Breaking ⚠️)
* `sdk->assessments->get()`:  `response.detail->incompleteSources[]->lane->enum(domain)` **Added** (Breaking ⚠️)
* `sdk->assessments->query()`:  `response.items[]->incompleteSources[]->lane->enum(domain)` **Added** (Breaking ⚠️)
* `sdk->accounts->listAssessments()`:  `response.items[]->incompleteSources[]->lane->enum(domain)` **Added** (Breaking ⚠️)

## 13.0.3

No changes detected.

## 13.0.2

No changes detected.

## 13.0.1

* `sdk->assessments->create()`:  `response.account->risk->decision->enum(held)` **Added** (Breaking ⚠️)
* `sdk->assessments->get()`:  `response.account->risk->decision->enum(held)` **Added** (Breaking ⚠️)
* `sdk->accounts->listChanged()`:  `response.items[]->risk->decision->enum(held)` **Added** (Breaking ⚠️)
* `sdk->accounts->get()`:  `response.risk->decision->enum(held)` **Added** (Breaking ⚠️)

## 13.0.0

No changes detected.

## 12.0.0

* `sdk->keyusage->record()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->accounts->delete()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->assessments->create()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->assessments->get()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->assessments->delete()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->assessments->recordOutcome()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->assessments->query()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->integrations->create()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->keys->rotate()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->accounts->listAssessments()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->replayDelivery()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->listDeliveries()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->accounts->get()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->integrations->list()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->integrations->delete()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->integrations->rotate()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->list()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->create()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->delete()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->rotateSigningKey()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->webhookendpoints->sendTestEvent()`:  `error.code->enum(riskVersionAhead)` **Added** (Breaking ⚠️)
* `sdk->accounts->listChanged()`: **Added**
* `sdk->accounts->recordEnforcement()`: **Added**

## 11.0.1

No changes detected.

## 11.0.0

No changes detected.

## 10.0.2

* `sdk->assessments->create()`:  `response.account->riskVersion` **Added**
* `sdk->assessments->get()`:  `response.account->riskVersion` **Added**
* `sdk->accounts->get()`:  `response.riskVersion` **Added**

## 10.0.1

No changes detected.

## 10.0.0

* `sdk->keys->rotate()`:  `response.scopes[]->enum(delete)` **Added** (Breaking ⚠️)

## 9.0.2

No changes detected.

## 9.0.1

No changes detected.

## 9.0.0

* `sdk->assessments->create()`: 
  *  `request.body->flow` **Changed** (Breaking ⚠️)
  *  `response` **Changed** (Breaking ⚠️)
  *  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->get()`: 
  *  `response` **Changed** (Breaking ⚠️)
  *  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->delete()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->recordOutcome()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->assessments->query()`: 
  *  `response.items[]->risk` **Changed** (Breaking ⚠️)
  *  `error.code` **Changed** (Breaking ⚠️)
* `sdk->accounts->get()`: 
  *  `response` **Changed** (Breaking ⚠️)
  *  `error.code` **Changed** (Breaking ⚠️)
* `sdk->accounts->delete()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->accounts->listAssessments()`: 
  *  `response.items[]->risk` **Changed** (Breaking ⚠️)
  *  `error.code` **Changed** (Breaking ⚠️)
* `sdk->keyusage->record()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->keys->rotate()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->create()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->list()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->delete()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->integrations->rotate()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->list()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->create()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->delete()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->rotateSigningKey()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->sendTestEvent()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->listDeliveries()`:  `error.code` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->replayDelivery()`:  `error.code` **Changed** (Breaking ⚠️)

## 8.0.1

No changes detected.

## 8.0.0

* `sdk->webhookendpoints->listDeliveries()`:  `response.items[]->eventType` **Changed** (Breaking ⚠️)
* `sdk->webhookendpoints->replayDelivery()`:  `response.eventType` **Changed** (Breaking ⚠️)

## 7.0.5

No changes detected.

## 7.0.4

No changes detected.

## 7.0.3

No changes detected.

## 7.0.2

No changes detected.

## 7.0.1

No changes detected.

## 7.0.0

* `sdk->assessments->create()`:  `response.account->risk->reasons[]->code->enum(sharedApiKey)` **Added** (Breaking ⚠️)
* `sdk->assessments->get()`:  `response.account->risk->reasons[]->code->enum(sharedApiKey)` **Added** (Breaking ⚠️)
* `sdk->assessments->query()`:  `response.items[]->risk->reasons[]->code->enum(sharedApiKey)` **Added** (Breaking ⚠️)
* `sdk->accounts->get()`:  `response.risk->reasons[]->code->enum(sharedApiKey)` **Added** (Breaking ⚠️)
* `sdk->accounts->listAssessments()`:  `response.items[]->risk->reasons[]->code->enum(sharedApiKey)` **Added** (Breaking ⚠️)
* `sdk->keyusage->record()`: **Added**

## 6.0.3

No changes detected.

## 6.0.2

No changes detected.

## 6.0.1

No changes detected.

## 6.0.0

* `sdk->assessments->create()`: 
  *  `request.body` **Changed** (Breaking ⚠️)
  *  `response` **Changed** (Breaking ⚠️)
* `sdk->assessments->get()`:  `response` **Changed** (Breaking ⚠️)

## 5.0.11

* `sdk->assessments->delete()`: **Added**

## 5.0.10

No changes detected.

## 5.0.9

No changes detected.

## 5.0.8

No changes detected.

## 5.0.7

* `sdk->accounts->delete()`: **Added**

## 5.0.6

* `sdk->assessments->create()`:  `request.body` **Changed**

## 5.0.5

No changes detected.

## 5.0.4

* `sdk->webhookendpoints->listDeliveries()`: **Added**
* `sdk->webhookendpoints->replayDelivery()`: **Added**

## 5.0.3

No changes detected.

## 5.0.2

No changes detected.

## 5.0.1

No changes detected.

## 5.0.0

* `sdk->assessments->create()`:  `response.risk->reasons[]->code->enum(testScenario)` **Added** (Breaking ⚠️)
* `sdk->assessments->get()`:  `response.risk->reasons[]->code->enum(testScenario)` **Added** (Breaking ⚠️)
* `sdk->assessments->query()`:  `response.items[]->risk->reasons[]->code->enum(testScenario)` **Added** (Breaking ⚠️)
* `sdk->accounts->get()`:  `response.risk->reasons[]->code->enum(testScenario)` **Added** (Breaking ⚠️)
* `sdk->accounts->listAssessments()`:  `response.items[]->risk->reasons[]->code->enum(testScenario)` **Added** (Breaking ⚠️)

## 4.1.10

No changes detected.

## 4.1.9

No changes detected.

## 4.1.8

No changes detected.

## 4.1.7

No changes detected.

## 4.1.6

No changes detected.

## 4.1.5

No changes detected.

## 4.1.4

* `sdk->accounts->get()`: **Added**
* `sdk->accounts->listAssessments()`: **Added**

## 4.1.3

No changes detected.

## 4.1.2

No changes detected.

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
