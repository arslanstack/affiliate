// Basic

new TomSelect("#input-tags",{
	persist: false,
	createOnBlur: true,
	create: true
});


// Select Box

new TomSelect("#select-beast",{
	create: true,
	sortField: {
		field: "text",
		direction: "asc"
	}
});


// Multi Select

new TomSelect("#select-state",{
    maxItems: 3
});


// Disabled Option

new TomSelect("#select-beast-single-disabled",{
	create: true,
	sortField: {field: "text"}
});


// Disabled Select

new TomSelect("#select-beast-disabled");

