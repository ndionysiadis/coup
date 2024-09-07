declare namespace App.Data {
export type CategoryData = {
id: number | null;
menuId: number | null;
totalProducts: number | null;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
products: any | any | Array<App.Data.ProductData> | null;
menuType: any | any | Array<App.Data.MenuTypeData> | null;
};
export type MenuTypeData = {
id: number | null;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
totalCategories: any | any | number;
totalProducts: any | any | number;
categories: any | any | Array<App.Data.CategoryData> | null;
};
export type ProductData = {
id: number | null;
categoryId: number | null;
name: string;
price: string | null;
image: string | null;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
category: any | any | Array<App.Data.CategoryData> | null;
};
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
