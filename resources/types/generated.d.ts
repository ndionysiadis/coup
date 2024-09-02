declare namespace App.Data {
export type CategoryData = {
id: number;
menuId: number;
totalProducts: number;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
products: any | any | Array<App.Data.ProductData> | null;
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
id: number;
categoryId: number;
name: string;
price: number | null;
image: string | null;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
category: App.Data.CategoryData | null;
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
