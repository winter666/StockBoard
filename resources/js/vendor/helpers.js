export default {
  asImageTag(url, alt = 'Картинка', count = 1) {
    let width = '100%';
    if (count % 2 === 0) {
      width = '45%';
    }
    if (count !== 1 && (count % 2 > 0 || count % 3 === 0)) {
      width = '30%';
    }

    return `<img src="${url}" alt="${alt}" style="width: ${width}; margin: 0 5px;"/>`;
  },
};
