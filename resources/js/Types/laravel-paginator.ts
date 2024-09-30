interface LaravelPaginator<T> {
    data: T[];
    links: LaravelPaginatorLink[];
    meta: LaravelPaginatorMeta
}
