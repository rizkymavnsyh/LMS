<div class="lp-box-data-content">
    <div class="learn-press-question">
        <div class="content-editable" contenteditable="true"
             @mouseup="canInsertBlank"
             @mousedown="activeBlank"
             @keyup="updateAnswer"></div>
        <div class="description">
            <p><?php _e( 'Select a word in passage above and click <strong>\'Insert new blank\'</strong> to make that word is a blank for filling.', 'learnpress-fill-in-blank' ); ?></p>
        </div>
        <p>
            <button class="button" type="button"
                    @click="insertBlank"
                    :disabled="!canInsertNewBlank"><?php _e( 'Insert new blank', 'learnpress-fill-in-blank' ); ?></button>
            <button class="button" type="button"
                    @click="clearBlanks"
                    :disabled="blanks.length == 0"><?php _e( 'Clear all blanks', 'learnpress-fill-in-blank' ); ?></button>
            <button class="button" type="button"
                    @click="clearContent"><?php _e( 'Clear content', 'learnpress-fill-in-blank' ); ?></button>
        </p>

        <table class="fib-blanks">
            <tbody v-for="blank in blanks" :data-id="'fib-blank-' + blank.id" class="fib-blank"
                   :class="{ invalid: !blank.fill, open: blank.open }">
            <tr>
                <td class="blank-position" width="50">#{{blank.index}}</td>
                <td class="blank-fill">
                    <input type="text" :id="'fib-blank-' + blank.id" v-model="blank.fill"
                           @keyup="updateBlank" @change="updateBlank">
                </td>
                <td class="blank-actions">
                    <span class="blank-status"></span>

                    <a class="button" href=""
                       @click="toggleOptions($event, blank.id)"><?php _e( 'Options', 'learnpress-fill-in-blank' ); ?></a>
                    <a class="delete button" href=""
                       @click="removeBlank($event, blank.id)"><?php _e( 'Delete', 'learnpress-fill-in-blank' ); ?></a>
                </td>
            </tr>
            <tr class="blank-options">
                <td width="50"></td>
                <td colspan="2">
                    <ul>
                        <li>
                            <label>
                                <input type="checkbox" v-model="blank.match_case"
                                       @click="updateAnswerBlank($event, blank)">
								<?php _e( 'Match case', 'learnpress-fill-in-blank' ); ?></label>
                            <p class="description"><?php _e( 'Match two words in case sensitive.', 'learnpress-fill-in-blank' ); ?></p>
                        </li>
                        <li><h3><?php _e( 'Comparison', 'learnpress-fill-in-blank' ); ?></h3></li>
                        <li>
                            <label>
                                <input type="radio" value="" v-model="blank.comparison"
                                       @click="updateAnswerBlank($event, blank)">
								<?php _e( 'Equal', 'learnpress-fill-in-blank' ); ?></label>
                            <p class="description"><?php _e( 'Match two words are equality.', 'learnpress-fill-in-blank' ); ?></p>
                        </li>
                        <li>
                            <label>
                                <input type="radio" value="range" v-model="blank.comparison"
                                       @click="updateAnswerBlank($event, blank)">
								<?php _e( 'Range', 'learnpress-fill-in-blank' ); ?></label>
                            <p class="description"><?php _e( 'Match any number in a range. Use <code>100, 200</code> will match any value from 100 to 200.', 'learnpress-fill-in-blank' ); ?></p>
                        </li>
                        <li>
                            <label>
                                <input type="radio" value="any" v-model="blank.comparison"
                                       @click="updateAnswerBlank($event, blank)">
								<?php _e( 'Any', 'learnpress-fill-in-blank' ); ?></label>
                            <p class="description"><?php _e( 'Match any value in a set of words. Use <code>fill, blank, question</code> will match any value in the set.', 'learnpress-fill-in-blank' ); ?></p>
                        </li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
