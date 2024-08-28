declare namespace App.Data {
export type CategoryData = {
id: number;
menuId: number;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
menuType: App.Data.MenuTypeData;
products: App.Data.ProductData | null;
};
export type MenuTypeData = {
id: number;
name: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
deletedAt: string | null;
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
export type UserData = {
id: number;
name: string;
email: string;
};
}
