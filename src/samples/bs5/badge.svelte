<script lang="ts">
  import Example from './__example.svelte';
  import Badge from './badge-badge.svelte';
  import BadgeButton from './badge-badgebutton.svelte';
  import BadgeLinks from './badge-badgelinks.svelte';
  import Colors from './badge-colors.svelte';
  import Pills from './badge-pills.svelte';
  import badgeButtonSource from './badge-badgebutton.svelte';
  import Badge_src from './badge-badge.svelte';
  import badgeLinksSource from './badge-badgelinks.svelte';
  import Colors_src from './badge-colors.svelte';
  import Pills_src from './badge-pills.svelte';
</script>

<h1>Badges</h1>
<a href="https://getbootstrap.com/docs/5.0/components/badge/" target="_blank">
  Bootstrap Badges
</a>

<Example source={Badge_src}>
  <p slot="info">Badges scale to parent.</p>
  <Badge />
</Example>

<Example source={badgeButtonSource}>
  <p slot="info">
    Badges can be used as part of links or buttons to provide a counter.
  </p>
  <BadgeButton />
</Example>

<Example title="Colors" source={Colors_src}>
  <Colors />
</Example>

<Example title="Pills" source={Pills_src}>
  <Pills />
</Example>

<Example title="Links" source={badgeLinksSource}>
  <p slot="info">Adding the href prop will default the badge to a link.</p>
  <BadgeLinks />
</Example>
