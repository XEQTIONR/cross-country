<template>
    <dl>
        <dt>User:</dt>
        <dd>{{ name ?? 'None' }}</dd>
        <dd>{{ email ?? 'None' }}</dd>
    </dl>
</template>

<script>
export default {
    props: {
        email: String,
        name: String
    }
}
</script>