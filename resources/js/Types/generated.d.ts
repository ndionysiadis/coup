declare namespace App.Data {
export type ToastData = {
message: string | null;
type: any | null;
position: any | null;
};
export type UserData = {
id: number;
name: string;
email: string;
};
}
declare namespace App.Data.Archive {
export type ArchiveData = {
archivedMenus: Array<App.Data.Menu.MenuTypeData> | null;
archivedCategories: Array<App.Data.Category.CategoryData> | null;
archivedProducts: Array<App.Data.Product.ProductData> | null;
};
export type ArchiveIndexPageData = {
archivedMenus: Array<App.Data.Menu.MenuTypeData>;
archivedCategories: Array<App.Data.Category.CategoryData>;
archivedProducts: Array<App.Data.Product.ProductData>;
term: string;
};
}
declare namespace App.Data.Category {
export type CategoryData = {
id: number | null;
menuId: number | null;
totalProducts: number | null;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
products: any | any | Array<App.Data.Product.ProductData> | null;
menuType: any | App.Data.Menu.MenuTypeData | null;
};
export type CategoryIndexPageData = {
categories: Array<App.Data.Category.CategoryData>;
term: string;
};
export type CategoryShowPageData = {
category: App.Data.Category.CategoryData;
products: Array<App.Data.Product.ProductData>;
term: string;
};
}
declare namespace App.Data.Menu {
export type MenuTypeData = {
id: number | null;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
totalCategories: any | any | number;
totalProducts: any | any | number;
categories: any | any | Array<App.Data.Category.CategoryData> | null;
};
export type MenuTypeIndexPageData = {
menuTypes: Array<App.Data.Menu.MenuTypeData>;
term: string;
};
export type MenuTypeShowPageData = {
menuType: App.Data.Menu.MenuTypeData;
categories: Array<App.Data.Category.CategoryData>;
term: string;
};
}
declare namespace App.Data.Product {
export type ProductData = {
id: number | null;
categoryId: any | number | null;
name: string;
price: string;
image: string | null;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
category: any | App.Data.Category.CategoryData | null;
};
export type ProductPageData = {
products: Array<App.Data.Product.ProductData>;
term: string;
};
}
