# Select components

This guide covers **`Select`** (custom, Radix-style listbox) and **`NativeSelect`** (native `<select>`). Both live under [`src/components/ui/`](../../src/components/ui/) and share the **`options`** array shape for simple forms; only **`Select`** supports generic value types and the full compound API.

**Related:** [Form patterns](./form-patterns.md) · [Inputs](./inputs.md) · [Accessibility](./accessibility.md) · [UI overview](./README.md)

---

## 1. Which component to use

| Goal | Component |
|------|-----------|
| Branded dropdown, keyboard listbox, `string` or custom `T` | **`Select`** |
| OS-native picker (especially mobile), `string` / `number` values | **`NativeSelect`** |
| Searchable or very long lists | Combobox / command palette (not covered here) |
| Multiple values | Multi-select or checkboxes |
| On/off | **`Switch`** or checkbox |
| Few visible mutually exclusive choices | **`RadioGroup`** |

---

## 2. `Select` — architecture

**`Select`** is a thin wrapper around a **custom listbox** (not a native `<select>` in the trigger UI). It adds:

- Generic **`Option<T>`** typing for **`value`**, **`onChange`**, and **`defaultValue`**
- An **`options`** prop that renders **`SelectItem`** children automatically
- A **hidden native `<select>`** when **`name`** is set (see [Forms](#6-select--forms-and-name))

### Compound parts (advanced)

For layouts that do not fit a flat **`options`** list, use the same primitives as Radix Select:

| Export | Role |
|--------|------|
| **`Select`** | Root; pass **`options`** *or* compose children |
| **`SelectTrigger`** | Opens listbox; shows selected label or **`placeholder`** |
| **`SelectContent`** | Portaled listbox panel |
| **`SelectItem`** | One **`value`** + label (children) |
| **`SelectGroup`** / **`SelectLabel`** | Sections |
| **`SelectSeparator`** | Visual divider |
| **`SelectValue`** | Optional slot for custom value display |
| **`SelectScrollUpButton`** / **`SelectScrollDownButton`** | Long lists |

**`SelectTrigger`** sets **`data-size`** (`default` | `sm`) for styling. Invalid state: **`aria-invalid`** on the trigger (e.g. from **`aria-invalid={!!errors.field}`**).

---

## 3. `Select` — props (`SelectProps<T>`)

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| **`options`** | **`SelectOption<T>[]`** | — | **`{ value, label, disabled? }`**; drives **`SelectItem`** list |
| **`value`** | **`Option<T> \| null`** | — | Controlled selected value |
| **`onChange`** | **`(value: Option<T> \| null) => void`** | — | Called when selection changes |
| **`defaultValue`** | **`Option<T> \| undefined`** | — | Uncontrolled initial value |
| **`placeholder`** | **`string`** | **`'Select…'`** | Shown on trigger when nothing selected |
| **`disabled`** | **`boolean`** | **`false`** | Disables trigger |
| **`name`** | **`string`** | — | Hidden **`<select name>`** for traditional form POST |
| **`id`** | **`string`** | auto **`useId()`** | Trigger **`id`**; wire **`Label htmlFor`** |
| **`className`** | **`string`** | — | Merged onto **`SelectTrigger`** |
| **`children`** | **`ReactNode`** | — | Extra nodes inside root (rare); **`options`** still render items |

**`SelectOption<T>`:** **`value: T`**, **`label: string`**, optional **`disabled?: boolean`**.

**`T`** must be consistent across **`options`**, **`value`**, **`onChange`**, and **`defaultValue`**. Use **`as const`** on option values when **`T`** is a string union.

---

## 4. `Select` — basic example

```tsx
import { useState } from 'react';
import { Label } from '@/components/ui/label';
import { Select, type Option } from '@/components/ui/select';

const PLAN_OPTIONS = [
  { value: 'free' as const, label: 'Free' },
  { value: 'pro' as const, label: 'Pro' },
  { value: 'team' as const, label: 'Team' },
];

function PlanField() {
  const [plan, setPlan] = useState<Option<'free' | 'pro' | 'team'> | null>(null);

  return (
    <div className="grid gap-2">
      <Label htmlFor="plan">Plan</Label>
      <Select
        id="plan"
        options={PLAN_OPTIONS}
        value={plan}
        onChange={setPlan}
        placeholder="Choose a plan"
      />
    </div>
  );
}
```

---

## 5. Before / after usage

### Custom `<select>` with manual state (before)

Ad hoc native markup duplicates styling, omits listbox keyboard behavior, and scatters option data:

```tsx
function StatusFilterBefore() {
  const [status, setStatus] = useState('');

  return (
    <div>
      <label>Status</label>
      <select
        className="border rounded px-2 py-1"
        value={status}
        onChange={(e) => setStatus(e.target.value)}
      >
        <option value="">All</option>
        <option value="open">Open</option>
        <option value="closed">Closed</option>
      </select>
    </div>
  );
}
```

### `Select` with `options` (after)

One **`options`** array, shared design tokens, listbox a11y, and typed **`Option<T>`**:

```tsx
import { Label } from '@/components/ui/label';
import { Select, type Option } from '@/components/ui/select';

const STATUS_OPTIONS = [
  { value: 'open' as const, label: 'Open' },
  { value: 'closed' as const, label: 'Closed' },
];

function StatusFilterAfter() {
  const [status, setStatus] = useState<Option<'open' | 'closed'> | null>(null);

  return (
    <div className="grid gap-2">
      <Label htmlFor="status">Status</Label>
      <Select
        id="status"
        options={STATUS_OPTIONS}
        value={status}
        onChange={setStatus}
        placeholder="All"
      />
    </div>
  );
}
```

Use **`null`** (and **`placeholder`**) for “no filter” instead of a sentinel empty string when the parent state is **`Option<T> | null`**.

### Inline native picker (before → after)

**Before:** raw **`<select>`** in a table toolbar.

**After:** **`NativeSelect`** with **`variant="inline"`** and the same **`options`** shape:

```tsx
<NativeSelect
  variant="inline"
  options={[
    { value: 10, label: '10 rows' },
    { value: 25, label: '25 rows' },
    { value: 50, label: '50 rows' },
  ]}
  value={pageSize}
  onChange={(e) => setPageSize(Number(e.target.value))}
  aria-label="Rows per page"
/>
```

---

## 6. `Select` — forms and `name`

When **`name`** is provided, a visually hidden **`<select>`** mirrors the current value so **native HTML form submit** includes the field.

- Prefer **controlled** **`value`** + **`onChange`** in React apps that handle submit in JS.
- For classic **`<form action="…" method="post">`**, set **`name`** and ensure **`value`** updates before submit.

Hidden select uses **`options`** for **`<option>`** elements; disabled options are omitted from the native mirror when appropriate (see implementation).

---

## 7. `Select` — controlled vs uncontrolled

| Mode | Props | Display |
|------|-------|---------|
| **Controlled** | **`value`** + **`onChange`** | Always follows **`value`** |
| **Uncontrolled** | **`defaultValue`** only | Initial selection from **`defaultValue`** |

Do not mix **`value`** and **`defaultValue`** on the same instance.

---

## 8. `Select` — keyboard and pointer behavior

Behavior matches [Radix Select](https://www.radix-ui.com/primitives/docs/components/select) (see [`select.tsx`](../../src/components/ui/select.tsx)):

| Input | Result |
|-------|--------|
| Click trigger | Open / close |
| Click option | Select, close, focus trigger |
| **`ArrowDown` / `ArrowUp`** (closed, focused trigger) | Open; move highlight |
| **`ArrowDown` / `ArrowUp`** (open) | Move highlight |
| **`Home` / `End`** (open) | First / last enabled option |
| Type characters (open) | Typeahead to matching **label** |
| **`Enter` / `Space`** (open) | Select highlighted option |
| **`Escape`** | Close; focus trigger |
| Click outside | Close |

List items use roving **`tabIndex`**; listbox uses **`aria-activedescendant`** when open.

---

## 9. `Select` — accessibility

| Element | Notes |
|---------|--------|
| Trigger | **`button`**, **`aria-haspopup="listbox"`**, **`aria-expanded`**, **`id`** |
| Listbox | **`role="listbox"`**; items **`role="option"`** |
| Label | **`Label htmlFor={id}`** or **`aria-label`** on trigger |
| Disabled | Trigger **`disabled`**; options **`aria-disabled`** + no selection |
| Invalid | **`aria-invalid`** on trigger (pair with **`aria-describedby`** for errors) |

**`SelectLabel`** (section headings) is **`aria-hidden`**; options carry the meaningful names.

---

## 10. `Select` — styling

Tailwind tokens (**`border-input`**, **`bg-popover`**, focus rings, **`data-[placeholder]`** on trigger). Pass **`className`** on **`Select`** (applies to trigger) or on **`SelectTrigger`** / **`SelectContent`** when composing manually.

---

## 11. `NativeSelect` — purpose and DOM

**`NativeSelect`** renders a real **`<select>`** with the same **`options`** prop pattern. Values are **`string | number`** only.

```
NativeSelect
├── <select>  (ref, name, id, required, …rest)
│   ├── optional placeholder <option value="" disabled hidden>
│   └── <option> × N
└── chevron (aria-hidden)
```

**`variant`:** **`default`** (full width) | **`inline`** (compact).

---

## 12. `NativeSelect` — props

| Prop | Type | Description |
|------|------|-------------|
| **`options`** | **`NativeSelectOption[]`** | **`value: string \| number`**, **`label`**, optional **`disabled`** |
| **`placeholder`** | **`string`** | Inserts hidden empty first option |
| **`variant`** | **`'default' \| 'inline'`** | Layout |
| **`className`** | **`string`** | Wrapper |
| **`…rest`** | **`<select>`** attrs | **`value`/`onChange`**, **`defaultValue`**, **`name`**, **`required`**, **`disabled`**, **`autoComplete`**, etc. |

---

## 13. `NativeSelect` — example

```tsx
<NativeSelect
  id="country"
  name="country"
  options={[
    { value: 'us', label: 'United States' },
    { value: 'ca', label: 'Canada' },
  ]}
  placeholder="Country"
  required
/>
```

---

## 14. `Select` vs `NativeSelect`

| | **`Select`** | **`NativeSelect`** |
|---|-------------|-------------------|
| DOM | Custom listbox (portal) | **`<select>`** |
| Value typing | Generic **`T`**, **`null`** | **`string \| number`** in options |
| API | **`options`** or compound parts | Single component |
| Placeholder | **`placeholder`** on trigger | Empty **`option`** |
| Form | Optional hidden **`<select>`** via **`name`** | Native **`name`** / **`value`** |
| UX | Consistent desktop styling | Platform-native menu (esp. mobile) |

---

## 15. Common mistakes

**`Select`**

1. **`onChange`** without **`value`** — UI does not reflect parent state.
2. Duplicate **`value`** among enabled **`options`**.
3. Missing visible label or **`aria-label`**.
4. Using **`Select`** for multi-select or typeahead — wrong control.

**`NativeSelect`**

1. Expecting **`SelectTrigger`** / **`SelectContent`** — use **`Select`** instead.
2. **`null`** as an option **`value`** — use **`''`** with **`placeholder`**.

---

## 16. File reference

| File | Exports |
|------|---------|
| [`select.tsx`](../../src/components/ui/select.tsx) | **`Select`**, **`SelectTrigger`**, **`SelectContent`**, **`SelectItem`**, … |
| [`native-select.tsx`](../../src/components/ui/native-select.tsx) | **`NativeSelect`**, **`nativeSelectVariants`** |

---

## 17. External references

- [Radix Select](https://www.radix-ui.com/primitives/docs/components/select)
- [MDN: `<select>`](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/select)
