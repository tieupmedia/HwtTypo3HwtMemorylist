# HwtTypo3HwtMemorylist
## Install Note:
Name the extension folder "hwt_memorylist"!

## About:
This TYPO3 extension provides a flexible memory list for TYPO3 >= 7.6

## Features:

**Conceptual + Backend**

- Add universal record types to a memory list, configurable via typoscript

**Plugin - Frontend**

- Plugin to show memory list in frontend
- Plugin actions to add, remove and show list in FE via ajax
- Demo buttons to call plugin actions adaptable in custom extensions / templates

**Integration**

- Installable via Composer

## Manual:

### Create control elments to add / remove items
The memory list is designed to work with ajax controls, to add or remove items from the list. So just create the related control elements and initialize them with the ajax javascript.

The controls need three data attributes:
- **data-hwtmemorylist-model** with a value of the record types defined in `plugin.tx_hwtmemorylist.settingsrecordTypes`
- **data-hwtmemorylist-recordid** with a value of the uid of the record to add or remove
- **data-hwtmemorylist-action** with a value 'add' or 'remove' to declare, what action should be done

Example:
```
<a href="#" class="hwtmemorylist-ctrl" data-hwtmemorylist-model="AShortRecordIdentifier" data-hwtmemorylist-recordid="1" data-hwtmemorylist-action="add">
```
See more examples in the '_ListDemoItemControls_' partial.

Initialize Ajax:

To initialize the ajax calling, bind the elements to the _hwtmemorylistCtrlInit()_ function.
```
jQuery('.hwtmemorylist-ctrl').on('click', hwtmemorylistCtrlInit);
```
In the Ajax.js file included in this extension, initializes elements with the css class _'hwtmemorylist-ctrl' by default_.

### How to configure a custom record for the memory list
To register a new record type for the memory list, add it to the _'recordTypes'_ in the TypoScript settings. Choose a custom record identifier and and configure the repository class in the subproperty. 

(The repository _must implement the function 'findByUid'_.)
```
plugin.tx_hwtmemorylist.settings {
    recordTypes {
        AShortRecordIdentifier {
            repository = Vendor\Extension\Domain\Repository\TheModelRepository
        }
    }
}
```

## Versions:
- \>= 0.0.4 for TYPO3 7.6 - 8.7

## Migrations:
**0.0.5 to 0.0.6**
The TypoScript key `plugin.tx_hwtmemorylist.settings.list.recordtypes` moved to `plugin.tx_hwtmemorylist.settings.recordTypes`.
