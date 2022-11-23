# TPEspecial-2

This is a simple tool that lets you easily a CRUD to the Mollusca catalog, using RESTful interface.

## Resource name maps to the endpoint url:

## Auth Token:

GET - With an specific useremail and password, you will reach a token that allows to CREATE, MODIFY and DELETE items from different entities:

    http://localhost/Web2/TPE/TPEspecial-2/api/auth/token

## Api-Class:

GET - You can get all registers from the Entity "Class":
    http://localhost/Web2/TPE/TPEspecial-2/api/classes

GET ID - You cand get the register from the Entity "Class" with an specific id:
    http://localhost/Web2/TPE/TPEspecial-2/api/classes/:id

POST - You can create a new register from the Entity "Class"; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/classes

PUT - You can modify a register from the Entity "Class" with an specific id; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/classes/:id

DELETE - You can delete a register from the Entity "Class" with an specific id; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/classes/:id

## Api-Subclass:

GET - You can get all registers from the Entity "Subclass":
    http://localhost/Web2/TPE/TPEspecial-2/api/subclasses

GET ID - You cand get the register from the Entity "Subclass" with an specific id:
    http://localhost/Web2/TPE/TPEspecial-2/api/subclasses/:id

POST - You can create a new register from the Entity "Subclass"; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/subclasses

PUT - You can modify a register from the Entity "Subclass" with an specific id; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/subclasses/:id

DELETE - You can delete a register from the Entity "Subclass" with an specific id; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/subclasses/:id

## Api-Species:

GET - You can get all registers from the Entity "Species":
    http://localhost/Web2/TPE/TPEspecial-2/api/species

GET ID - You cand get the register from the Entity "Species" with an specific id:
    http://localhost/Web2/TPE/TPEspecial-2/api/species/:id

POST - You can create a new register from the Entity "Species"; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/species

PUT - You can modify a register from the Entity "Species" with an specific id; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/species/:id

DELETE - You can delete a register from the Entity "Species" with an specific id; token is required:
    http://localhost/Web2/TPE/TPEspecial-2/api/species/:id

## Filtering
In the GET endpoint, add two query params:
    ?filter="name of column"
    ?value="value to filter"

The default will be 1 and 1

## Sorting
In the GET endpoint, add this query params:
    ?orderBy="name of column"

The default will be id column

## Condition
In the GET endpoint, add two query params:
    ?cond=desc or asc

The default will be asc

## Pagination
In the GET endpoint, add two query params:
    ?page=name of the page
    ?limit=quantity of items