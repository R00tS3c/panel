export async function search(search, attribute) {
  const {
    data: { resources },
  } = await Nova.request().get(`/nova-api/${attribute}/search`, {
    params: {
      search: search,
      current: null,
      first: false,
      // withTrashed: true,
    },
  })

  return { resources }
}
