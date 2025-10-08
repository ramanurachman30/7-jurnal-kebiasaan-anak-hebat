<?php

namespace App\Routes;

class WebRouteNames
{
    // USER
    public const USER_ACTIVATION = 'activation.page';
    public const USER_UPDATE_PROFILE = 'update_profile';
    public const USER_UPDATE_PROFILE_GET = 'update_profile.get';

    // ROLES
    public const ROLES_STORE = 'store';
    public const ROLES_CREATE = 'create';
    public const ROLES_EDIT = 'edit';
    public const ROLES_UPDATE = 'update';

    // Collection
    public const COLLECTION_LIST = 'list';
    public const COLLECTION_CREATE = 'create_page';
    public const COLLECTION_STORE = 'store_page';
    public const COLLECTION_EDIT = 'edit_page';
    public const COLLECTION_UPDATE = 'update_page';
    public const COLLECTION_DETAIL = 'detail_page';
    public const COLLECTION_DELETE = 'delete_page';
    public const COLLECTION_TRASH = 'trash_page';
    public const COLLECTION_TRASHED = 'trashed_page';
    public const COLLECTION_RESTORE = 'restore_page';

    // Collection Publish
    public const COLLECTION_PUBLISH = 'publish';
    public const COLLECTION_SAVE_PUBLISH = 'save_publish';
    public const COLLECTION_DRAFT = 'draft';
    public const COLLECTION_SET_AS_DRAFT = 'set_as_draft';
}
