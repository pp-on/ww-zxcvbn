import { zxcvbn, zxcvbnOptions } from '@zxcvbn-ts/core'
import * as zxcvbnCommonPackage from '@zxcvbn-ts/language-common'
import * as zxcvbnEnPackage from '@zxcvbn-ts/language-en'
import * as zxcvbnDePackage from '@zxcvbn-ts/language-de'

const password = 'somePassword'
const options = {
    translations: {
     ...zxcvbnEnPackage.translations,
     ...zxcvbnDePackage.translations,
    },
  graphs: zxcvbnCommonPackage.adjacencyGraphs,
  dictionary: {
    ...zxcvbnCommonPackage.dictionary,
    ...zxcvbnEnPackage.dictionary,
    ...zxcvbnDePackage.dictionary,
  },
}

zxcvbnOptions.setOptions(options)

zxcvbn(password)

