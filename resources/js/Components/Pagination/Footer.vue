<script setup lang="ts">
import Copyrights from "@/Components/Copyrights.vue";
import {
    PhAt,
    PhFacebookLogo,
    PhInstagramLogo,
    PhMapPin,
    PhPhone,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
</script>

<template>
    <footer
        class="flex flex-col items-center justify-center gap-2 bg-gray-800/70 p-2"
    >
        <div class="flex items-center gap-4">
            <AppLink href="https://www.facebook.com/CoupEspressoWine" blank>
                <PhFacebookLogo
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="https://www.instagram.com/coupespressowinebar" blank>
                <PhInstagramLogo
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="https://maps.app.goo.gl/zjSKnrGaE43eZSJb9" blank>
                <PhMapPin
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="callto:2384501161" blank>
                <PhPhone
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="mailto:coup.ewb@gmail.com" blank>
                <PhAt
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>
        </div>
        <Copyrights />
    </footer>
</template>
