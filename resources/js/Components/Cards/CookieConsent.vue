<script setup lang="ts">
import { VueCookieNext } from "vue-cookie-next";
import { ref, onMounted } from "vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";

const showBanner = ref(true);

onMounted(() => {
    const consent = VueCookieNext.getCookie("cookie_consent");
    showBanner.value = !(consent === "true" || consent === "false");
});

const acceptCookies = () => {
    VueCookieNext.setCookie("cookie_consent", "true", { expire: "7d" });
    showBanner.value = false;
};

const rejectCookies = () => {
    VueCookieNext.setCookie("cookie_consent", "false", { expire: "7d" });
    showBanner.value = false;
};
</script>

<template>
    <div
        v-motion-slide-bottom
        :delay="350"
        :duration="800"
        v-if="showBanner"
        class="fixed bottom-0 left-0 right-0 z-30 flex flex-col items-center text-center text-sm bg-gray-950/30 p-4 text-gray-50 backdrop-blur-sm"
    >
        <span>
            Ο ιστότοπος χρησιμοποιεί cookies αποκλειστικά για αναλυτικούς
            σκοπούς.
        </span>

        <span class="pb-4">
            Μπορείτε να διαβάσετε περισσότερα στη Πολιτική Cookie στο τέλος της σελίδας.
        </span>

       <div class="flex items-center gap-2">
           <PrimaryButton @click="acceptCookies">Αποδοχή</PrimaryButton>
           <SecondaryButton @click="rejectCookies">Απόρριψη</SecondaryButton>
       </div>
    </div>
</template>
